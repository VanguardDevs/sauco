<?php

use Illuminate\Database\Seeder;
use App\Models\VehicleParameter;

class VehicleParameterSeeder extends Seeder
{
    public $parameters = Array(
        "Bicicletas de reparto, deportivas y de paseo",
        "Motocicletas, motonetas y similares de uso particular y deportivo",
        "Motocicletas, motonetas y similares de trabajo",
        "Vehiculos de uso particular",
        "Rancheras, utilitarios, VAN o similares (2  ejes)",
        "Camionetas de carga, cerradas o abiertas (2 ejes)",
        "Camiones, Gandolas, Remolques y Similares (2 y 3 ejes)",
        "Transporte publico, taxis, libres y por puestos Urbanos, Interurbanos y perifericos",
        "Remolques o trailers de uso Industrial",
        "Maquinaria Pesada de uso en la construccion Hasta 4000kg.",
        "Gruas de cualquier capacidad de arrastre",
        "Casas rodantes, carrozas funebres, ambulancias y transporte de valores",
        "Colectivos de uso privado",
        "Vehiculos de uso particular  (2 ejes) 1000kg",
        "Vehiculos de uso particular  (2 ejes) 1001kg hasta 1500kg",
        "Vehiculos de uso particular  (2 ejes) 1501kg hasta 2000kg",
        "Vehiculos de uso particular  (2 ejes)  2001kg en adelante",
        "Camiones de carga, cerradas o abiertas (2 ejes) Hasta 1000kg.",
        "Camiones de carga, cerradas o abiertas (2 ejes) Desde 1001kg Hasta 1500kg.",
        "Camiones de carga, cerradas o abiertas (2 ejes) Desde 1501kg Hasta 2000kg.",
        "Camiones de carga, cerradas o abiertas (2 ejes) Desde 2001kg Hasta 3500kg.",
        "Transporte publico, taxis, libres y por puestos Urbanos, Interurbanos y perifericos hasta 5 puesto",
        "Transporte publico, taxis, libres y por puestos Urbanos, Interurbanos y perifericos Desde 501kg Hasta 1000kg",
        "Transporte publico, taxis, libres y por puestos Urbanos, Interurbanos y perifericos Desde 1001kg Hasta 1500kg",
        "Transporte publico, taxis, libres y por puestos Urbanos, Interurbanos y perifericos Desde 1501kg  en adelante",
        "Maquinaria Pesada de uso en la construccion Desde 4001kg Hasta 10000kg.",
        "Maquinaria Pesada de uso en la construccion Desde 10001kg en adelante."
    );
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->parameters as $key => $parameter) {
            VehicleParameter::create([
                'name' => $parameter
            ]);
        }
    }
}
