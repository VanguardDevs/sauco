<?php

use App\EconomicSector;
use Illuminate\Database\Seeder;

class EconomicSectorsTableSeeder extends Seeder
{
    private $sectors = Array(
        'INDUSTRIAL', 'SALUD', 'TURISMO', 'INMOBILIARIOS',
        'BANCA', 'TELECOMUNICACIONES E INFORMÁTICA',
        'INDUSTRIAS BÁSICAS', 'COMERCIO'
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
