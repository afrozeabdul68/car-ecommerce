<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ProductImportJob;
use App\Jobs\ProductImageImportJob;
use App\Jobs\ProductFeatureImportJob;

class BulkImportAPIJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:import_bulk';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import product, dealer, image and features via Marketcheck API';

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
        dump("Product Import started");
        dispatch(new ProductImportJob);
        dump("Product Feature Import started");
        dispatch(new ProductFeatureImportJob);
        dump("Product Image Import started");
        dispatch(new ProductImageImportJob);
    }
}
