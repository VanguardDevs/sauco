<?php

use App\Ordinance;
use Illuminate\Database\Seeder;

class OrdinancesTableSeeder extends Seeder
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
