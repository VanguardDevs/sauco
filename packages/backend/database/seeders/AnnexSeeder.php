<?php

namespace Database\Seeders;

use App\Models\AnnexedLiqueur;
use Illuminate\Database\Seeder;

class AnnexSeeder extends Seeder
{
    public $annexes = Array(
        "Abasto",
        "Supermercado",
        "Fraccionamiento",
        "Restaurante",
        "Salón de Baile",
        "Estadio",
        "Club Nocturno",
        "Hotel",
        "Centro Social",
        "Centro Deportivo",
        "Karaoke",
        "Billar",
        "Pool",
        "Independiente",
        "Bodega",
        "Salón de Juego",
        "Cerveza por copas",
        "Cerveza sola",
        "Gallera",
        "Agencia de Festejos",
        "Franquicia Movil",
        "Talento en vivo"
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->annexes as $key => $annex) {
            AnnexedLiqueur::create([
                'name' => $annex
            ]);
        }
    }
}
