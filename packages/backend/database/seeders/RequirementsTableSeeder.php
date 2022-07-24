<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Requirement;
use Illuminate\Support\Facades\DB;

class RequirementsTableSeeder extends Seeder
{

    protected $requirements = Array(
        ['1', 'Solicitud de Trámite para Instalación de Licencia de Expendio de Bebidas Alcohólicas.', '00000001', '105'],
        ['2', 'REGISTRO Y AUTORIZACIÓN PARA INSTALACIÓN DE EXPENDIO DE BEBIDAS ALCOHÓLICAS', '00000002', '21'],
        ['3', 'Solicitud de Trámite de Renovación de Licencia de Expendio de Bebidas Alcohólicas.', '00000003', '106'],
        ['4', 'RENOVACIÓN ANUAL DEL REGISTRO Y AUTORIZACION DE EXPENDIO', '00000004', '22'],
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->requirements as $row) {
            Requirement::create([
                'id' => $row[0],
                'name' => $row[1],
                'num' => $row[2],
                'concept_id' => $row[3]
            ]);
        }
    }
}
