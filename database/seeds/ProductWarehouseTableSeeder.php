<?php

use Illuminate\Database\Seeder;

class ProductWarehouseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\ProductWarehouse', 40)->create();

    }
}
