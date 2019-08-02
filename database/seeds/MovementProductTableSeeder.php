<?php

use Illuminate\Database\Seeder;

class MovementProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\MovementProduct', 40)->create();
    }
}
