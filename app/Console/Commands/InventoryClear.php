<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;

class InventoryClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inventory:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear tables for inventory';

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
        try {
            DB::beginTransaction();
            DB::table('dealer')->delete();
            dump("Dealers were deleted");

            DB::table('products_image')->delete();
            dump("Product images were deleted");

            DB::table('product_options')->delete();
            dump("Product options were deleted");

            DB::table('products')->delete();
            dump("Products were deleted");

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dump($e->getMessage());
        }
    }
}
