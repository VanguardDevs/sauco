<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EconomicActivity;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EconomicActivity::factory()->count(100)->create();
    }
}
