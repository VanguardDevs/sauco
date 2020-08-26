<?php

use Illuminate\Database\Seeder;
use App\State;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $states = Array(
		'AMAZONAS', 'ANZOÁTEGUI', 'APURE',
        'ARAGUA', 'BARINAS', 'BOLÍVAR',
        'CARABOBO', 'COJEDES', 'DELTA AMACURO',
        'DEPENDENCIAS FEDERALES', 'DISTRITO CAPITAL',
        'FALCÓN', 'GUÁRICO', 'LARA', 'MIRANDA',
        'MONAGAS', 'MONAGAS', 'MÉRIDA', 'NUEVA ESPARTA',
        'PORTUGUESA', 'SUCRE', 'TRUJILLO', 'TÁCHIRA',
        'LA GUAIRA', 'YARACUY', 'ZULIA'
	);

    public function run()
    {
    	foreach ($this->states as $key => $name) {
    		State::create([
    			'name' => $name,
                'code' => 'POR ASIGNAR'
    		]);
    	}
    }
}
