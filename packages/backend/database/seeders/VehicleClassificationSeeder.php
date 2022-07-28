<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleClassification;
use Illuminate\Support\Facades\DB;

class VehicleClassificationSeeder extends Seeder
{

    protected $classifications = Array(

        ["Bicicletas de Reparto, Deportivas y de Paseo", "0.01", 1, 2],
        ["Motocicletas, Motonetas y similares de uso particular y deportivo", "0.02", 1, 2],
        ["Motocicletas, Motonetas y similares de trabajo", "0.02", 1, 2],
        ["Más de 1Kg hasta 1,000Kg", "0.09", 1, 2],
        ["Más de 1,000Kg hasta 1,500Kg", "0.1", 1, 2],
        ["Más de 1,500Kg hasta 2,000Kg", "0.12", 1, 2],
        ["Más de 2,000Kg en adelante", "0.15", 1, 2],

        ["Más de 1,000Kg", "0.14", 2, 2],
        ["Más de 1,000Kg hasta 1,500Kg", "0.15", 2, 2],
        ["Más de 1,500Kg hasta 2,000Kg", "0.16", 2, 2],
        ["Más de 2,000Kg en adelante", "0.20", 2, 2],

        ["Más de 1,000Kg", "0.15", 3, 2],
        ["Más de 1,000Kg hasta 1,500Kg", "0.16", 3, 2],
        ["Más de 1,500Kg hasta 2,000Kg", "0.20", 3, 2],
        ["Más de 2,000Kg hasta 3,500Kg", "0.25", 3, 2],

        ["Más de 3,500Kg hasta 6,000Kg", "0.30", 4, 2],
        ["Más de 6,000Kg hasta 8,000Kg", "0.35", 4, 2],
        ["Más de 8,000Kg hasta 12,000Kg", "0.40", 4, 2],
        ["Más de 12,000Kg en adelante", "0.45", 4, 2],
        ["Casas Rodantes, Carrozas Fúnebres, Ambulancias y Transporte de Valores", "0.30", 4, 2],

        ["Hasta 5 puestos", "0.08", 5, 2],
        ["Desde 6 Hasta 15 puestos", "0.09", 5, 2],
        ["Desde 16 Hasta 24 puestos", "0.10", 5, 2],
        ["Desde 25 Hasta 32 puestos", "0.12", 5, 2],
        ["Desde 500Kg Hasta 1,000Kg de capacidad", "0.09", 5, 2],
        ["Desde 1,000Kg Hasta 1,500Kg", "0.10", 5, 2],
        ["Desde 1,500Kg en adelante", "0.12", 5, 2],

        ["Hasta 4,000Kg", "0.50", 6, 2],
        ["Desde 4,001Kg hasta 10,000Kg", "0.60", 6, 2],
        ["Desde 10,001Kg en adelante", "0.70", 6, 2],
        ["Grúas en cualquier capacidad de arrastre", "0.50", 6, 2]

    );
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->classifications as $classification) {
            DB::table('vehicle_classifications')->insert([
                'name' => $classification[0],
                'amount' => $classification[1],
                'vehicle_parameter_id' => $classification[2],
                'charging_method_id' => $classification[3]
            ]);
        }
    }
}
