<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Product;

class UpdateDealRatingPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deals:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Products Deal rating price from VinAudit API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();
        $products = Product::select('*')->get();
        foreach ($products as $key => $value) {
            $id = $value->id;
            $response = $client->request('GET', 'http://marketvalue.vinaudit.com/getmarketvalue.php?key=RX0Y395X9YW8F79&vin=' . $value->vin);
            $result = json_decode($response->getBody());

            if (isset($result->success) && $result->success) {
                $product = Product::where('id', $id)->update(['average_price' => $result->prices->average, 'below_price' => $result->prices->below, 'above_price' => $result->prices->above]);
                if ($product) {
                    dump("Updated");
                }
            }
        }
    }
}
