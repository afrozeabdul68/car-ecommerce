<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Dealer;

class ImportAPIDealer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:import_dealer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from the marketcheck api';

    public $urls;
    public $radius = 100000;
    public $start = 0;
    public $totalImports = 0;
    public $urlIndex = 0;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->urls = [
            'http://marketcheck-prod.apigee.net/v1/dealers?api_key=' . env('MARKET_CHECK_API_KEY') . '&latitude=43.1856307&longitude=-77.7565881',
            'http://marketcheck-prod.apigee.net/v1/dealers?api_key=' . env('MARKET_CHECK_API_KEY') . '&latitude=34.05&longitude=-118.24',
            'http://marketcheck-prod.apigee.net/v1/dealers?api_key=' . env('MARKET_CHECK_API_KEY') . '&latitude=39.73&longitude=-104.99'
        ];
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $start = $this->start;

        while (true) {
            if ($this->urlIndex >= count($this->urls)) {
                break;
            }

            $tries = 0;
            $rows = 100;
            $radius = $this->radius;
            $clienturl = $this->urls[$this->urlIndex] . '&radius=' . $radius . '&start=' . $start . '&rows=' . $rows . '&sort_by=id&sort_order=desc';

            try {
                $client = new Client();
                $res = $client->get($clienturl);
                $status = $res->getStatusCode();
                $response = $res->getBody();
                $response = json_decode($response);

                if (empty($response)) {
                    dd("Empty response");
                }

                $importedRows = $this->handleResponse($response->dealers);
                $this->totalImports += $importedRows;
                $this->urlIndex++;
            } catch (\Exception $e) {
                dump("Error: " . $e->getMessage());
                $tries++;

                if ($tries > 2) {
                    $this->urlIndex++;
                }

                sleep(1);
            }
        }

        dump("Total {$this->totalImports} rows imported.");
    }

    public function handleResponse($dealers)
    {
        $count = 0;

        foreach ($dealers as $dealer) {
            $dbDealer = Dealer::where('dealer_id', $dealer->id)->first();
            $dealerParams = [
                "dealer_id" => $dealer->id ?? '',
                "name" => $dealer->seller_name ?? '',
                "phone" => $dealer->seller_phone ?? '',
                "email" => $dealer->seller_email ?? '',
                "address" => $dealer->street ?? '',
                "state" => $dealer->state ?? '',
                "zip" => $dealer->zip ?? '',
                "city" => $dealer->city ?? '',
                "fax" => $dealer->seller_fax ?? '',
                "website" => $dealer->inventory_url ?? '',
                "latitude" => $dealer->latitude ?? '',
                "longitude" => $dealer->longitude ?? '',
                "distance" => $dealer->distance ?? '',
            ];

            if (!$dbDealer) {
                $dbDealer = Dealer::create($dealerParams);
            } else {
                $dbDealer->update($dealerParams);
            }

            $count++;
        }

        dump("{$count} dealers added");

        return $count;
    }
}
