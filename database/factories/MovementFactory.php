<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Movement;
use Faker\Generator as Faker;

$factory->define(Movement::class, function (Faker $faker) {
    return [
        'movement_type_id' => $faker->numberBetween(1,4),
        'document_type_id' => $faker->numberBetween(1,2),
        'document_number' => $faker->unique()->numerify('MT####'),
        'date' => \Carbon\Carbon::now()->format('Y-m-d'),
        'buyer' => $faker->numberBetween(1,10),
        'authorizer' => $faker->numberBetween(1,10),
        'deliverer' => $faker->numberBetween(1,10),
        'reciever' => $faker->numberBetween(1,10),
        'courier_description' => $faker->sentence(6, true),
        'origin' => $faker->numberBetween(1,5),
        'destination' => $faker->numberBetween(1,5),
        'confirmed'=>1,
        'created_at' => \Carbon\Carbon::now()->format('Y-m-d'),
        'updated_at' => \Carbon\Carbon::now()->format('Y-m-d'),
    ];
});
