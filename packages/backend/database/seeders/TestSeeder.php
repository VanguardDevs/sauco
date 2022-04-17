<?php

namespace Database\Seeders;

use App\Models\Taxpayer;
use App\Models\Liquidation;
use App\Models\CorrelativeType;
use App\Models\CorrelativeNumber;
use App\Models\Year;
use App\Models\Correlative;
use App\Models\Company;
use App\Models\Representation;
use App\Models\License;
use App\Models\LiqueurClassification;
use App\Models\LiqueurZone;
use App\Models\LiqueurParameter;
use App\Models\Liqueur;


use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Taxpayer::create([
            'id' => '1',
             'rif' => '12345',
             'name' => 'alguien',
             'address' => 'direccion',
             'phone' => '123456',
             'email' => 'example@gmail.com',
             'taxpayer_type_id' => '2',
             'parish_id' => '1',
             'community_id' => '1',
             'taxpayer_classification_id' => '1'
         ]);


         Liquidation::create([
             'num' => '10123',
             'amount' => '12',
             'liquidable_id' => '1',
             'liquidable_type' => 'algo',
             'liquidation_type_id' => '1',
             'taxpayer_id' => '1',
             'status_id' => '1',
             'concept_id' => '1',
             'user_id' => '1'
         ]);


         CorrelativeType::create([
             'description' => 'algo'

         ]);

         CorrelativeNumber::create([
             'num' => '12345'

         ]);

         Year::create([
             'year' => '2022'

         ]);

         Correlative::create([
             'correlative_type_id' => '1',
             'year_id' => '1',
             'correlative_number_id' => '1'

         ]);

         Company::create([
             'name' => 'algun nombre',
             'num_workers' => '5',
             'address' => 'direccion',
             'capital' => '12',
             'constitution_date' => '22-03-2022',
             'register_num' => '00000',
             'register_volume' => '11111',
             'register_casefile' => '01010',
             'parish_id' => '1',
             'community_id' => '1',
             'taxpayer_id' => '1',
             'phone' => '12365458',
             'email' => 'company@correo.com'
         ]);

         Representation::create([
            'id' => '1',
             'taxpayer_id' => '1',
             'company_id' => '1',
             'representation_type_id' => '1'

         ]);

         License::create([
             'num' => '10123',
             'active' => '1',
             'emission_date' => '01-01-2020',
             'expiration_date' => '01-01-2023',
             'taxpayer_id' => '1',
             'user_id' => '1',
             'representation_id' => '1',
             'correlative_id' => '1',
             'ordinance_id' => '1'

         ]);


         LiqueurClassification::create([
             'name' => 'algo',
             'abbreviature' => 'AL'

         ]);

         LiqueurZone::create([
             'name' => 'algo'
         ]);

         LiqueurParameter::create([
             'liqueur_classification_id' => '1',
             'liqueur_zone_id' => '1',
             'new_registry_amount' => '10',
             'renew_registry_amount' => '11',
             'movil' => '1'
         ]);


         Liqueur::create([
             'work_hours' => '2',
             'company_id' => '1',
             'liqueur_parameter_id' => '1',
             'representation_id' => '1',
             'license_id' => '1'

         ]);

    }
}
