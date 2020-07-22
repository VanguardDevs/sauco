<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Taxpayer;
use Faker\Generator as Faker;

$factory->define(Taxpayer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'rif' => $faker->name,
        'fiscal_address' => $faker->address,
        'phone' => $faker->phone,
        'email' => $faker->unique()->safeEmail      
    ];
});
