<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleParameter;
use Illuminate\Support\Facades\DB;


class VehicleParameterSeeder extends Seeder
{
    public $parameters = Array(

        ["Bicicletas de reparto, deportivas y de paseo", 1, 0, 0, 0],
        ["Motocicletas, motonetas y similares de uso particular y deportivo", 1, 0, 0, 0],
        ["Motocicletas, motonetas y similares de trabajo", 1, 0, 0, 0],
        ["Vehiculos de uso particular", 0, 1, 0, 0],
        ["Rancheras, utilitarios, VAN o similares (2  ejes)", 0, 1, 0, 0],
        ["Camionetas de carga, cerradas o abiertas (2 ejes)", null, 1, null, null],
        ["Camiones, Gandolas, Remolques y Similares (2 y 3 ejes)", 0, 1, 0, 0],
        ["Transporte publico, taxis, libres y por puestos Urbanos, Interurbanos y perifericos", 0, 0, 1, 0],
        ["Remolques o trailers de uso Industrial", 0, 1, 0, 0],
        ["Maquinaria Pesada de uso en la construccion Hasta 4000kg.", null, 1, null, null],
        ["Gruas de cualquier capacidad de arrastre", 1, 0, 0, 0],
        ["Casas rodantes, carrozas funebres, ambulancias y transporte de valores", 1, 0, 0, 0],
        ["Colectivos de uso privado", 1, 0, 0, 0],
        ["Vehiculos de uso particular  (2 ejes) 1000kg", null, 1, null, null],
        ["Vehiculos de uso particular  (2 ejes) 1001kg hasta 1500kg", null, 1, null, null],
        ["Vehiculos de uso particular  (2 ejes) 1501kg hasta 2000kg", null, 1, null, null],
        ["Vehiculos de uso particular  (2 ejes)  2001kg en adelante", null, 1, null, null],
        ["Camiones de carga, cerradas o abiertas (2 ejes) Hasta 1000kg.", null, 1, null, null],
        ["Camiones de carga, cerradas o abiertas (2 ejes) Desde 1001kg Hasta 1500kg.", null, 1, null, null],
        ["Camiones de carga, cerradas o abiertas (2 ejes) Desde 1501kg Hasta 2000kg.", null, 1, null, null],
        ["Camiones de carga, cerradas o abiertas (2 ejes) Desde 2001kg Hasta 3500kg.", null, 1, null, null],
        ["Transporte publico, taxis, libres y por puestos Urbanos, Interurbanos y perifericos hasta 5 puesto", null, null, 1, null],
        ["Transporte publico, taxis, libres y por puestos Urbanos, Interurbanos y perifericos Desde 501kg Hasta 1000kg", null, 1, null, null],
        ["Transporte publico, taxis, libres y por puestos Urbanos, Interurbanos y perifericos Desde 1001kg Hasta 1500kg", null, 1, null, null],
        ["Transporte publico, taxis, libres y por puestos Urbanos, Interurbanos y perifericos Desde 1501kg  en adelante", null, 1, null, null],
        ["Maquinaria Pesada de uso en la construccion Desde 4001kg Hasta 10000kg.", null, 1, null, null],
        ["Maquinaria Pesada de uso en la construccion Desde 10001kg en adelante.", null, 1, null, null]
    );
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->parameters as $parameter) {
            DB::table('vehicle_parameters')->insert([
                'name' => $parameter[0],
                'years' => $parameter[1],
                'weight' => $parameter[2],
                'capacity' => $parameter[3],
                'stalls' => $parameter[4]
            ]);
        }
    }
}
