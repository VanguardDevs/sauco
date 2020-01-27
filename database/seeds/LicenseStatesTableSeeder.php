<?php

use App\LicenseState;
use Illuminate\Database\Seeder;

class LicenseStatesTableSeeder extends Seeder
{
    private $states = Array(
        'INACTIVA', 'ACTIVA'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->states as $key => $value) {
            LicenseState::create([
                'description' => $value
            ]);
        }
    }
}
