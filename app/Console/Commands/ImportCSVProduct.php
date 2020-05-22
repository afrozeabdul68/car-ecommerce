<?php

namespace App\Console\Commands;

use App\Dealer;
use App\Product;
use Carbon\Carbon;
use App\ProductImage;
use App\ProductOption;
use Illuminate\Console\Command;

use DB;
use Config;
use Ftp;
use Log;

class ImportCSVProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing products from CSV files';

    public $ftp;
    public $index = 0;
    public $totalImports = 0;
    public $dealer;
    public $headers;
    public $credentials;

    public $bodyTags;
    public $makesTags;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->credentials = Config::get('ftp.connections.csv');

        $this->headers = Config::get('inventorycsv.csvHeaders');
        $this->bodyTags = Config::get('inventorycsv.body');
        $this->makesTags = Config::get('inventorycsv.makes');

        parent::__construct();

        try {
            $this->ftp = Ftp::connection();
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $files = $this->ftp->getDirListing('/feed/new');
        $newFiles = collect($files);

        $files = $this->ftp->getDirListing('/feed/used');
        $usedFiles = collect($files);

        $importFiles = $newFiles->merge($usedFiles);

        dump("CSV files found " . count($importFiles));

        $importFiles->map(function ($fileName) {
            $this->index = 0;

            try {
                $file = fopen("ftp://{$this->credentials['username']}:" . urlencode($this->credentials['password']) . "@{$this->credentials['host']}/$fileName", "r");

                dump("Importing products From $fileName");

                $importType = 'New';
                $paths = explode('/', $fileName);

                if ($paths[2] == 'new') {
                    $importType = 'New';
                } elseif ($paths[2] == 'used') {
                    $importType = 'Used';
                }

                $totalRows = $this->totalImports;
                while (($row = fgetcsv($file, 4096)) !== false) {
                    $this->processRow($row, $importType);
                }
                dump("Total Product Imported from $fileName :  " . ($this->totalImports - $totalRows));
                fclose($file);

                $this->ftp->delete($fileName);
            } catch (Exception $e) {
                dump($e->getMessage());
            }
        });

        dump("Total Product Imported {$this->totalImports}");
        Ftp::disconnect();
    }

    public function processRow($row, $importType = 'New')
    {
        $productFields = [
            "type" => "type",
            "stock_no_ss" => "stock",
            "vin_ss" => "vin",
            "year_is" => "year",
            "make_ss" => "make",
            "model_ss" => "model",
            "body_type_ss" => "body",
            "trim_ss" => "trim",
            "doors_is" => "doors",
            "exterior_color_ss" => "exteriorcolor",
            "interior_color_ss" => "interiorcolor",
            "cylinders_is" => "enginecylinders",
            "engine_size_ss" => "enginedisplacement",
            "transmission_ss" => "transmission",
            "miles_fs" => "miles",
            "price_fs" => "sellingprice",
            "msrp_fs" => "msrp",
            "is_certified_is" => "certified",
            "scraped_at_dts" => "dateinstock",
            "trim_orig_ss" => "style_description",
            "engine_block_ss" => "engine_block_type",
            "engine_ss" => "engine_description",
            "transmission_orig_ss" => "transmission_description",
            "drivetrain_orig_ss" => "drivetrain",
            "fuel_type_ss" => "fuel_type",
            "grouped_at_dts" => "updated_at",
            "latitude_fs" => "latitude",
            "longitude_fs" => "longitude",
            "zip_is" => "zip"
        ];

        $dealerFields = [
            "seller_name_orig_ss" => "name",
            "seller_email_ss" => "email",
            "seller_phone_ss" => "phone",
            "street_ss" => "address",
            "city_ss" => "city",
            "state_ss" => "state",
            "zip_is" => "zip",
            "latitude_fs" => "latitude",
            "longitude_fs" => "longitude"
        ];

        if ($this->index++ == 0) {
            if ($row[0] == 'id') {
                $this->headers = $row;

                return;
            }
        }

        $keys = $this->headers;
        $data = [];

        foreach ($keys as $key => $field) {
            $data[$field] = $row[$key] ?? '';
        }

        // Process dealer data
        $dealerId = $data['dealer_id_is'];

        if (!$dealerId) return;

        $dealerData = [];
        foreach ($dealerFields as $csvField => $dbField) {
            if ($data[$csvField]) {
                $dealerData[$dbField] = $data[$csvField];
            }
        }

        $dealer = Dealer::where('dealer_id', $dealerId)->first();

        // Process product data
        $product = [];
        $productOptions = [];
        $productImages = [];

        $data['type'] = $importType;
        $product['type'] = $importType;

        foreach ($keys as $field) {
            if ($field == 'body_type_ss') {
                $rawBody = strtolower($data[$field]);
                if (array_key_exists($rawBody, $this->bodyTags)) {
                    $product[$field] = $this->bodyTags[$rawBody];
                } else {
                    $product[$field] = ucfirst($data[$field]);
                }
            } else if ($field == 'make_ss') {
                $rawMakes = strtolower($data[$field]);

                if (array_key_exists($rawMakes, $this->makesTags)) {
                    $product[$field] = $this->makesTags[$rawMakes];
                } else {
                    $product[$field] = ucfirst($data[$field]);
                }
            } else if ($field == 'scraped_at_dts') {
                $product[$field] = Carbon::parse($data[$field])->format('Y-m-d');
            } else if ($field == 'grouped_at_dts') {
                $product[$field] = Carbon::parse($data[$field])->format('Y-m-d H:i:s');
            } else if ($field == 'miles_fs') {
                $product[$field] = !empty($data[$field]) ? intval($data[$field]) : 0;
            } else if ($field == 'is_certified_is') {
                $product[$field] = $data[$field] == 'N' ? 'False' : 'True';
            } else if (strstr($field, 'price_fs')) {
                $product[$field] = floatval($data[$field]);
            } elseif ($field == 'options_texts') {
                $ops = explode('|', $data[$field]);

                $type = DB::table('options_type_category')->where('type', 'general')->first();

                foreach ($ops as $op) {
                    if ($type) {

                        $p_option = $op;

                        // Check if option type already exists in table
                        $t = DB::table('options_types')->where([
                            'option_cat_id' => $type->id,
                            'slug' => str_slug($p_option)
                        ])->first();

                        if (empty($t)) {
                            $insert = [
                                'option_cat_id' => $type->id,
                                'name' => $p_option,
                                'slug' => str_slug($p_option),
                                'created_at' => date("Y-m-d H:i:s"),
                                'updated_at' => date("Y-m-d H:i:s")
                            ];

                            $t = DB::table('options_types')->insertGetId($insert);
                        }

                        $t = $t->id ?? $t;
                        $productOptions[] = [
                            'product_id' => '',
                            'product_options_cat_id' => $type->id,
                            'product_options_type_id' => $t
                        ];
                    }
                }
            } elseif ($field == 'features_texts') {
                // Save features
            } elseif ($field == 'interior') {
                $ops = explode(',', $data[$field]);

                $type = DB::table('options_type_category')->where('type', 'interior')->first();

                foreach ($ops as $op) {
                    if ($type) {

                        $p_option = $op;

                        // Check if option type already exists in table
                        $t = DB::table('options_types')->where([
                            'option_cat_id' => $type->id,
                            'slug' => str_slug($p_option)
                        ])->first();

                        if (empty($t)) {
                            $insert = [
                                'option_cat_id' => $type->id,
                                'name' => $p_option,
                                'slug' => str_slug($p_option),
                                'created_at' => date("Y-m-d H:i:s"),
                                'updated_at' => date("Y-m-d H:i:s")
                            ];

                            $t = DB::table('options_types')->insertGetId($insert);
                        }

                        $t = $t->id ?? $t;
                        $productOptions[] = [
                            'product_id' => '',
                            'product_options_cat_id' => $type->id,
                            'product_options_type_id' => $t
                        ];
                    }
                }
            } else if ($field == 'photo_links_ss') {
                $productImages  = explode('|', $data[$field]);
            } else if ($field == 'photo_url_ss') {
                $productImages  = explode('|', $data[$field]);
            } else {
                $product[$field] = $data[$field];
            }
        }

        try {
            DB::beginTransaction();
            $date = Carbon::now();

            // Save dealer
            $dealerData['dealer_id'] = $dealerId;
            if ($dealer) {
                $dealer->update($dealerData);
            } else {
                $dealer = Dealer::create($dealerData);
            }

            // Save product
            $dbProduct = [];
            foreach ($productFields as $csvField => $dbField) {
                $dbProduct[$dbField] = $product[$csvField];
            }

            $dbProduct['created_at'] = $date;
            $dbProduct['dealer_id'] = $dealerId;

            if (!$dbProduct['latitude']) {
                $dbProduct['latitude'] = $dealer->latitude;
            }

            if (!$dbProduct['longitude']) {
                $dbProduct['longitude'] = $dealer->longitude;
            }

            $preDBProduct = Product::with('images')->where(['vin' => $dbProduct['vin'], 'dealer_id' => $dealerId])->first();
            if (empty($preDBProduct)) {
                $pid = Product::insertGetId($dbProduct);
            } else {
                $preDBProduct->update($dbProduct);
                $pid = $preDBProduct->id;
            }

            $productOptions = array_map(function ($item) use ($pid, $date) {
                $item['product_id'] = $pid;
                $item['created_at'] = $date;
                $item['updated_at'] = $date;
                return $item;
            }, $productOptions);

            $productImages = array_map(function ($image) use ($pid, $date) {
                $item = [];
                $item['image'] = $image;
                $item['product_id'] = $pid;
                $item['created_at'] = $date;
                $item['updated_at'] = $date;
                return $item;
            }, $productImages);

            if (!empty($preDBProduct) && !empty($productImages)) {
                ProductImage::where('product_id', $pid)->delete();
            }

            if (!empty($productImages))
                ProductImage::insert($productImages);

            if (!empty($productOptions)) {
                ProductOption::where('product_id', $pid)->delete();
                ProductOption::insert($productOptions);
            }



            DB::commit();
            if (!empty($preDBProduct)) {
                dump("Product Updated {$pid}");
            } else {
                $this->totalImports++;
                dump("Product Imported {$pid}");
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            dump($e->getMessage());
        }
    }
}
