<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleClassification;
use Illuminate\Support\Facades\DB;

class VehicleClassificationSeeder extends Seeder
{

    protected $classifications = Array(

        ["Bicicletas de Reparto, Deportivas y de Paseo", "0.6", 1, 2],
        ["Motocicletas, Motonetas y similares de uso particular y deportivo", "1.2", 1, 2],
        ["Motocicletas, Motonetas y similares de trabajo", "1.2", 1, 2],
        ["Más de 1Kg hasta 1,000Kg", "5.4", 1, 2],
        ["Más de 1,000Kg hasta 1,500Kg", "6", 1, 2],
        ["Más de 1,500Kg hasta 2,000Kg", "7.2", 1, 2],
        ["Más de 2,000Kg en adelante", "9", 1, 2],

        ["Más de 1,000Kg", "8.4", 2, 2],
        ["Más de 1,000Kg hasta 1,500Kg", "9", 2, 2],
        ["Más de 1,500Kg hasta 2,000Kg", "9.6", 2, 2],
        ["Más de 2,000Kg en adelante", "12", 2, 2],

        ["Más de 1,000Kg", "9", 3, 2],
        ["Más de 1,000Kg hasta 1,500Kg", "9.6", 3, 2],
        ["Más de 1,500Kg hasta 2,000Kg", "12", 3, 2],
        ["Más de 2,000Kg hasta 3,500Kg", "15", 3, 2],

        ["Más de 3,500Kg hasta 6,000Kg", "18", 4, 2],
        ["Más de 6,000Kg hasta 8,000Kg", "21", 4, 2],
        ["Más de 8,000Kg hasta 12,000Kg", "24", 4, 2],
        ["Más de 12,000Kg en adelante", "27", 4, 2],
        ["Casas Rodantes, Carrozas Fúnebres, Ambulancias y Transporte de Valores", "18", 4, 2],

        ["Hasta 5 puestos", "4.8", 5, 2],
        ["Desde 6 Hasta 15 puestos", "5.4", 5, 2],
        ["Desde 16 Hasta 24 puestos", "6", 5, 2],
        ["Desde 25 Hasta 32 puestos", "7.2", 5, 2],
        ["Desde 500Kg Hasta 1,000Kg de capacidad", "5.4", 5, 2],
        ["Desde 1,000Kg Hasta 1,500Kg", "6", 5, 2],
        ["Desde 1,500Kg en adelante", "7.2", 5, 2],

        ["Hasta 4,000Kg", "30", 6, 2],
        ["Desde 4,001Kg hasta 10,000Kg", "36", 6, 2],
        ["Desde 10,001Kg en adelante", "42", 6, 2],
        ["Grúas en cualquier capacidad de arrastre", "30", 6, 2]

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
