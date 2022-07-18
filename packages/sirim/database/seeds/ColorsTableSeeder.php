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
        "Beige",
        "Blanco",
        "Castaño",
        "Cobre",
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
        "Morado",
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
