<?php

use Illuminate\Database\Seeder;
use App\State;
use App\Municipality;

class MunicipalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $municipalities = [
    	'SUCRE' => ['ANDRÉS ELOY BLANCO', 'ANDRÉS MATA', 'ARISMENDI',
        	'BENÍTEZ', 'BERMÚDEZ', 'BOLIVAR', 'CAJIGAL',
        	'CRUZ SALMERÓN ACOSTA', 'LIBERTADOR', 'MARIÑO',
        	'MEJÍA', 'MONTES', 'RIBERO', 'SUCRE', 'VALDEZ'],
        'AMAZONAS' => ['ALTO ORINOCO', 'ATABAPO', 'ATURES', 'AUTANA',
            'MANAPIARE', 'MAROA', 'RIO NEGRO'],
        'CARABOBO' => ['BEJUMA', 'CARLOS ARVELO', 'DIEGO IBARRA',
            'GUACARA', 'JUAN JOSE MORA', 'LIBERTADOR',
            'LOS GUAYOS', 'MIRANDA', 'MOTALBÁN', 'NAGUANAGUA',
            'PUERTO CABELLO', 'SAN DIEGO', 'SAN JOAQUÍN', 'VALENCIA'],
        'ANZOÁTEGUI' => ['ANACO', 'ARAGUA', 'BOLÍVAR', 'BRUZUAL',
            'CAJIGAL', 'CARVAJAL', 'FREITES', 'GUANIPA', 'GUANTA',
            'INDEPENDENCIA', 'LIBERTAD', 'MCGREGOR', 'MIRANDA', 'MONAGAS',
            'PEÑALVER', 'PÍRITU', 'SAN JUAN DE CAPISTRANO', 'SANTA ANA',
            'SIMÓN RODRÍGUEZ', 'SOTILLO', 'URBANEJA'],
        'APURE' => ['ACHAGUAS', 'BIRUACA', 'CAMEJO',
            'MUÑOZ', 'PÁEZ', 'RÓMULO GALLEGOS', 'SAN FERNANDO'],
        'ARAGUA' => ['ALCÁNTARA', 'BOLÍVAR', 'CAMATAGUA', 'GIRARDOT',
            'IRAGORRY', 'LAMAS', 'LIBERTADOR', 'MARIÑO', 'MICHELENA',
            'OCUMARE DE LA COSTA DE ORO', 'REVENGA', 'RIBAS', 'SAN CASIMIRO',
            'SAN SEBASTIÁN', 'SUCRE', 'TOVAR', 'URDANETA', 'ZAMORA'],
        'BARINAS' => ['ALBERTO ARVELO TORREALBA', 'ANDRÉS ELOY BLANCO',
            'ANTONIO JOSÉ DE SUCRE', 'ARISMENDI', 'BARINAS', 'BOLÍVAR',
            'CRUZ PAREDES', 'EZEQUIEL ZAMORA', 'OBISPOS', 'PEDRAZA',
            'ROJAS', 'SOSA'],
        'BOLÍVAR' => ['ANGOSTURA', 'CARONÍ', 'CEDEÑO', 'CHIEN', 'EL CALLAO',
            'GRAN SABANA', 'HERES', 'PIAR', 'ROSCIO', 'SIFONTES', 'SUCRE'],
        'COJEDES' => ['ANZOÁTEGUI', 'TINAQUILLO', 'GIRARDOT', 'LIMA BLANCO',
            'PAO DE SAN JUAN BAUTISTA', 'RICAURTE', 'RÓMULO GALLEGOS',
            'EZEQUIEL ZAMORA', 'TINACO'],
        'DELTA AMACURO' => ['ANTONIO DÍAZ', 'CASACOIMA', 'PEDERNALES', 'TUCUPITA'],
        'FALCÓN' => ['ACOSTA', 'BOLÍVAR', 'BUCHIVACOA', 'CARIRUBANA', 'COLINA',
            'DABAJURO', 'DEMOCRACIA', 'FALCÓN', 'FEDERACIÓN', 'ITURRIZA',
            'JACURA', 'LOS TAQUES', 'MANAURE', 'MAUROA', 'MIRANDA', 'PALMASOLA',
            'PETIT', 'PÍRITU', 'SAN FRANCISCO', 'SUCRE', 'SILVA', 'TOCÓPERO',
            'UNIÓN', 'URUMACO', 'ZAMORA'],
        'GUÁRICO' => ['CAMAGUÁN', 'CHAGUARAMAS', 'EL SOCORRO', 'LAS MERCEDES',
            'LEONARDO INFANTE', 'JULIÁN MELLADO', 'FRANCISCO DE MIRANDA',
            'MONAGAS', 'ORTIZ', 'RIBAS', 'ROSCIO', 'SAN GERÓNIMO DE GUAYABAL',
            'SAN JOSÉ DE GUARIBE', 'SANTA MARÍA DE IPIRE', 'ZARAZA'],
        'LARA' => ['BLANCO', 'CRESPO', 'IRIBARREN', 'JIMÉNEZ', 'MORÁN',
            'PALAVECINO', 'PLANAS', 'TORRES', 'URDANETA'],
        'MÉRIDA' => ['ADRIANI', 'ANDRÉS BELLO', 'ARICAGUA', 'BRICEÑO', 'CHACÓN',
            'CAMPO ELÍAS', 'DÁVILA', 'FEBRES CORDERO', 'GUARAQUE', 'LIBERTADOR',
            'MIRANDA', 'NOGUERA', 'PARRA OLMEDO', 'PINTO SALINAS', 'PUEBLO LLANO',
            'QUINTERO', 'RANGEL', 'RAMOS DE LORA', 'SALAS', 'MARQUINA', 'SUCRE',
            'TOVAR', 'ZEA'],
        'MIRANDA' => ['ACEVEDO', 'ANDRÉS BELLO', 'BARUTA', 'BRIÓN', 'BOLÍVAR',
            'BUROZ', 'CARRIZAL', 'CHACAO', 'CRISTÓBAL ROJAS', 'EL HATILLO',
            'GUAICAIPURO', 'GUAL', 'INDEPENDENCIA', 'LANDER', 'LOS SALIAS',
            'PÁEZ', 'PAZ CASTILLO', 'PLAZA', 'SUCRE', 'URDANETA', 'ZAMORA'],
        'MONAGAS' => ['ACOSTA', 'AGUASAY', 'BOLÍVAR', 'CARIPE', 'CEDEÑO',
            'LIBERTADOR', 'MATURÍN', 'PIAR', 'PUNCERES', 'SANTA BÁRBARA',
            'SOTILLO', 'URACOA', 'ZAMORA'],
        'NUEVA ESPARTA' => ['ANTOLÍN DEL CAMPO', 'ARISMENDI', 'DÍAZ', 'GARCÍA',
            'GÓMEZ', 'MACANAO', 'MANEIRO', 'MARCANO', 'MARIÑO', 'TUBORES', 'VILLALBA'],
        'PORTUGUESA' => ['AGUA BLANCA', 'ARAURE', 'ESTELLER', 'GUANARE',
            'GUANARITO', 'OSPINO', 'PÁEZ', 'PAPELÓN', 'SAN GENARO DE BOCONOÍTO',
            'SAN RAFAEL DE ONOTO', 'SANTA ROSALÍA', 'SUCRE', 'TURÉN', 'UNDA'],
        'TÁCHIRA' => ['ANDRÉS BELLO', 'AYACUCHO', 'BOLÍVAR', 'CÁRDENAS',
            'CÓRDOBA', 'FERNÁNDEZ', 'GUÁSIMOS', 'HEVIA', 'INDEPENDENCIA',
            'JÁUREGUI', 'JUNÍN', 'LIBERTAD', 'LIBERTADOR', 'LOBATERA',
            'MALDONADO', 'MICHELENA', 'MIRANDA', 'PANAMERICANO', 'RÓMULO COSTA',
            'SAN CRISTÓBAL', 'SAN JUDAS TADEO', 'SEBORUCO', 'SIMÓN RODRÍGUEZ',
            'SUCRE', 'TORBES', 'URDANETA', 'UREÑA', 'URIBANTE', 'VARGAS'],
        'TRUJILLO' => ['ANDRÉS BELLO', 'BOCONÓ', 'BOLÍVAR', 'CANDELARIA',
            'CARACHE', 'CAMPOS ELÍAS', 'CARVAJAL', 'ESCUQUE', 'LA CEIBA',
            'MÁRQUEZ CAÑIZALES', 'MIRANDA', 'MONTE CARMELO', 'MOTATÁN',
            'PAMPÁN', 'PAMPANITO', 'RANGEL', 'SUCRE', 'TRUJILLO', 'URDANETA',
            'VALERA'],
        'LA GUAIRA' => ['VARGAS'],
        'YARACUY' => ['ARÍSTIDES BASTIDAS', 'BOLÍVAR', 'BRUZUAL', 'COCOROTE',
            'INDEPENDENCIA', 'LA TRINIDAD', 'MONGE', 'NIRGUA', 'PÁEZ',
            'SAN FELIPE', 'SUCRE', 'URARICHE', 'VEROES'],
        'ZULIA' => ['BOLÍVAR', 'BARALT', 'CABIMAS', 'CATATUMBO', 'COLÓN',
            'GUAJIRA', 'PADILLA', 'PULGAR', 'LOSSADA', 'SEMPRÚN', 'LA CAÑADA DE URDANETA',
            'LAGUNILLAS', 'MACHIQUES', 'MARA', 'MARACAIBO', 'MIRANDA', 'ROSARIO',
            'SAN FRANCISCO', 'SANTA RITA', 'SUCRE', 'VALMORE RODRÍGUEZ'],
        'DISTRITO CAPITAL' => ['NO APLICA'],
        'DEPENDENCIAS FEDERALES' => ['NO APLICA']
    ];

    public function getStateID($stateName) {
        $states = State::all(); // Retrieve all states

        foreach($states as $state) {
            if ($state->name == $stateName) {
                return $state->id;
            }
        }
    }

    public function run()
    {
        foreach($this->municipalities as $stateName => $municipalityNames) {
            $stateID = $this->getStateID($stateName);   // Get ID

            // Now, I know there's another way, I just got lazy
            foreach($municipalityNames as $name) {
                Municipality::create([
                    'state_id' => $stateID,
                    'name' => $name
                ]);
            }
        }
    }
}
