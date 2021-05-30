<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LiquidationType;

class LiquidationTypesSeeder extends Seeder
{
    protected $lists = Array(
        'Solicitudes',
        'Multas',
        'Impuesto a la Actividad Económica',
        'Permisos',
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
