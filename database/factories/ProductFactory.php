<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'code' => $faker->unique()->numerify('E####'),
        'description' => $faker->sentence(6, true),
        'brand' => $faker->cityPrefix,
        'serie' => $faker->unique()->bothify('??###??####'),
        'category_id' => $faker->numberBetween(1,4),
        'state_id' => $faker->numberBetween(1,5),
        'size_id' => $faker->numberBetween(1,5),
        'calibration_id' => $faker->numberBetween(1,10),
        'created_at' => \Carbon\Carbon::now()->format('Y-m-d'),
        'updated_at' => \Carbon\Carbon::now()->format('Y-m-d'),
    ];
});
