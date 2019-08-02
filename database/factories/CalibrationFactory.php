<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Calibration;
use Faker\Generator as Faker;

$factory->define(Calibration::class, function (Faker $faker) {
    return [
        'last' => $faker->date('Y-m-d','now'), // '1979-06-09',
        'next' => $faker->date('Y-m-d','now'),
        'details' => $faker->sentence(6, true),
        'created_at' => \Carbon\Carbon::now()->format('Y-m-d'),
        'updated_at' => \Carbon\Carbon::now()->format('Y-m-d'),
    ];
});
