<?php

use Illuminate\Database\Seeder;

class CalibrationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Calibration',10)->create();
    }
}
