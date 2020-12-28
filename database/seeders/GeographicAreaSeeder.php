<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Community;

class GeographicAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Community::factory()->count(10)->create();
    }
}
