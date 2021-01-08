<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\LiquidationType;

class LiquidationTypesSeeder extends Seeder
{
    protected $lists = Array(
        'Solicitudes',
        'Multas',
        'Actividad Económica'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->lists as $value) {
            LiquidationType::create([
                'name' => $value
            ]);
        }
    }
}
