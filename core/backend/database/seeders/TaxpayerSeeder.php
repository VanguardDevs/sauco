<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Taxpayer;
use App\Models\Municipality;
use App\Models\Community;
use App\Models\TaxpayerType;
use App\Models\TaxpayerClassification;

class TaxpayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classification = TaxpayerClassification::first();
        $type = TaxpayerType::first();
        $municipality = Municipality::first();
        $community = Community::first();

        Taxpayer::factory()->count(10)
            ->for($classification)
            ->for($type)
            ->for($municipality)
            ->for($community)
            ->create();
    }
}
