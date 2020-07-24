<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Taxpayer;
use App\TaxpayerType;
use App\TaxpayerClassification;
use App\Community;
use Faker\Generator as Faker;

$factory->define(Taxpayer::class, function (Faker $faker) {
    return [
        'name' => $faker->catchPhrase,
        'rif' => $faker->numerify('#######-#'),
        'fiscal_address' => $faker->address,
        'phone' => $faker->tollFreePhoneNumber,
        'email' => $faker->unique()->safeEmail,
        'community_id' => Community::get()->random(1)->first(),     
        'taxpayer_classification_id' => TaxpayerClassification::get()->random(1)->first(), 
        'taxpayer_type_id' => TaxpayerType::get()->random(1)->first()  
    ];
});
