<?php

use Illuminate\Database\Seeder;

use App\Models\AnnexedLiqueur;

class LiqueurAnnexSeeder extends Seeder
{

     public $liqueurannexes = Array(
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
        foreach ($this->liqueurannexes as $key => $liqueurannex) {
            AnnexedLiqueur::create([
                'name' => $liqueurannex
            ]);
        }
    }
}
