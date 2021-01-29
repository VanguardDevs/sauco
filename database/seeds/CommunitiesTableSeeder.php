<?php

use Illuminate\Database\Seeder;
use App\Community;

class CommunitiesTableSeeder extends Seeder
{
    protected $communities = Array(
        'CENTRO',
        'LOS MOLINOS',
        'UVEROS',
        'COPEY',
        'COPACABANA',
        'GÜIRIA DE LA PLAYA',
        'PATILLA',
        'POZO COLORADO',
        'GUATAPANARE',
        'PLAYA GRANDE',
        'LAS PEONIAS',
        'HATO ROMAN',
        'GUACA',
        'LEBRANCHE',
        'EL MACO',
        'TAPARO',
        'URB. LA ESTANCIA',
        'JOSÉ FRANCISCO BERMÚDEZ',
        'LA VIÑA',
        '1º DE MAYO',
        'GUAYACÁN DE LAS FLORES',
        'CHARALLAVE',
        'CANCHUNCHÚ',
        'LOMA DE GRAN POBRE',
        'EL CHARCAL',
        'EL LIRIO',
        '9º DE ABRIL',
        'VERSALLES',
        'EL MUCO',
        'URB. EL MANGLE',
        'LOS COCOS',
        'ALTAMIRA',
        'LAS AZUCENAS',
        'URB. PEDRO ELÍAS ARISTIGUETA',
        'CORAZÓN DE MI PATRIA',
        'CAMPO AJURO',
        'PUCHURUCO',
        'AEROPUERTO',
        'BRISAS DEL CARMEN',
        'MATURINCITO',
        '22 DE AGOSTO',
        'EL BAJO',
        'BOCA DE RÍO',
        'SAN MARTÍN',
        'CUSMA',
        'EL VALLE',
        '23º DE ENERO',
        'TACOA',
        'EL TIGRE',
        'CURACHO'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->communities as $key => $value) {
            Community::create([
                'name' => $value
            ]);
        }
    }
}
