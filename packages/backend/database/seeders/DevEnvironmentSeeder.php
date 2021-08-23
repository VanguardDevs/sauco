<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Taxpayer;
use App\Models\Company;

class DevEnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $taxpayers = Taxpayer::factory()->count(5)->create();

        foreach($taxpayers as $taxpayer) {
            Company::factory()->state([
                'parish_id' => $taxpayer->community->parishes->first()->id,
                'community_id' => $taxpayer->community_id,
                'taxpayer_id' => $taxpayer->id
            ])->create();
        }
    }
}
