<?php

use Illuminate\Database\Seeder;

class MovementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Movement', 25)->create();
    }
}
