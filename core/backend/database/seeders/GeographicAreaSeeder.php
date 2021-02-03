<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Municipality;
use App\Models\Community;
use App\Models\Parish;
use App\Models\State;

class GeographicAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::factory()->count(15)
            ->has(
                Municipality::factory()
                    ->count(1)
                    ->has(Parish::factory()
                        ->count(3)
                        ->has(Community::factory()->count(3)))
            )->create();
    }
}
