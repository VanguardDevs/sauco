<?php

use Illuminate\Database\Seeder;
use App\Color;

class ColorsTableSeeder extends Seeder
{
    protected $colors = Array(
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
        "Cobre",
        "Vinotinto"
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->colors as $key => $value) {
            Color::create([
                'name' => $value
            ]);
        }
    }
}
