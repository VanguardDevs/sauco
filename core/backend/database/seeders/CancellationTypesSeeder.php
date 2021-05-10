<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CancellationType;

class CancellationTypesSeeder extends Seeder
{
    protected $lists = Array(
        'Solicitudes',
        'Sanciones y Recargas',
        'Declaración Jurada de Ingresos',
        'Pagos',
        'Deducciones y Retenciones',
        'Liquidaciones'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->lists as $value) {
            CancellationType::create([
                'name' => $value
            ]);
        }
    }
}
