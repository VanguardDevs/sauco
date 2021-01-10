<?php

namespace Database\Seeders;

use App\Ordinance;
use Illuminate\Database\Seeder;

class OrdinancesSeeder extends Seeder
{
    protected $names = Array(
        'ACTIVIDAD ECONÓMICA',
        'INMUEBLES',
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
