<?php

use App\EconomicSector;
use Illuminate\Database\Seeder;

class EconomicSectorsTableSeeder extends Seeder
{
    private $sectors = Array(
        'INDUSTRIA', 'COMERCIO', 'INMUEBLES', 'TURISMO', 'LICORES'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->sectors as $key => $value) {
            EconomicSector::create([
                'description' => $value
            ]);
        }
    }
}
