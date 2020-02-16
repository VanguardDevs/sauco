<?php

use App\OwnershipState;
use Illuminate\Database\Seeder;

class OwnershipStatesTableSeeder extends Seeder
{
    private $statuses = Array(
        'ALQUILADO', 'PROPIO'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statuses as $key => $value) {
            OwnershipState::create([
                'description' => $value
            ]);
        }
    }
}
