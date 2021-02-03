<?php

namespace Database\Seeders;

use App\Models\Ordinance;
use Illuminate\Database\Seeder;

class OrdinancesSeeder extends Seeder
{
    protected $names = Array(
        'Actividad Económica',
        'Aseo urbano',
        'Inmuebles',
        'Vehículos',
        'Cementerio',
        'Mercado',
        'Terminal de pasajeros',
        'Mercado',
        'Expendios del Licores'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->names as $key => $value) {
            Ordinance::create([
                'description' => $value
            ]);
        }
    }
}
