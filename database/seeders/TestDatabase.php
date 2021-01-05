<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Municipality;
use App\Parish;
use App\State;
use App\Community;

class TestDatabase extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::create([
            'code' => 'S',
            'name' => 'Sucre'
        ]);

        Municipality::factory()
            ->has(
                Parish::factory()
                    ->count(3)
                    ->has(
                        Community::factory()->count(3)
                    )
            )->create();
    }
}
