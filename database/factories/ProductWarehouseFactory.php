<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ProductWarehouse;
use Faker\Generator as Faker;

$factory->define(ProductWarehouse::class, function (Faker $faker) {
    return [
        'product_id' => $faker->unique()->numberBetween(1,40),
        'warehouse_id' => 5,
        'stock' => $faker->numberBetween(0,100),
        'confirmed' => 1,
        'created_at' => \Carbon\Carbon::now()->format('Y-m-d'),
        'updated_at' => \Carbon\Carbon::now()->format('Y-m-d'),
    ];
});
