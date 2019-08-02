<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\MovementProduct;
use Faker\Generator as Faker;

$factory->define(MovementProduct::class, function (Faker $faker) {
    return [
        'movement_id' => 12,
        'product_id' => $faker->unique()->numberBetween(1,40),
        'quantity' => $faker->numberBetween(1,50),
        'confirmed' => 1,
        'created_at' => \Carbon\Carbon::now()->format('Y-m-d'),
        'updated_at' => \Carbon\Carbon::now()->format('Y-m-d'),
    ];
});
