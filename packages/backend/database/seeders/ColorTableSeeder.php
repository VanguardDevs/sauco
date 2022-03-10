<?php

namespace Database\Seeders;

use App\Model\Color;
use Illuminate\Database\Seeder;

class ColorTableSeeder extends Seeder
{

    public $colors = Array(

        "Aguamarina",
        "Amarillo",
        "Anaranjado",
        "Azul",
        "Azul celeste",
        "Azul Francia",
        "Azul marino",
        "Azul pizarra",
        "Blanco",
        "Castaño",
        "Coral",
        "Dorado",
        "Dorado brillante",
        "Durazno",
        "Fucsia",
        "Gris",
        "Gris pizarra",
        "Indigo",
        "Lavanda",
        "Lila",
        "Madera",
        "Marron",
        "Negro",
        "Ocre",
        "Oliva",
        "Orquidea",
        "Plata",
        "Purpura",
        "Rojo",
        "Rojo escarlata",
        "Rosado",
        "Turquesa",
        "Verde",
        "Verde azulado",
        "Verde botella",
        "Verde limon",
        "Verde mar",
        "Verde oscuro",
        "Violeta",
        "Morado",
        "beize",
        "COBRE",
        "VINOTINTO",
        "BEIGE (MULTICOLOR)"
    );
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->colors as $key => $color) {
            Color::create([
                'name' => $color
            ]);
        }
    }
}