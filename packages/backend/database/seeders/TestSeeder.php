<?php

namespace Database\Seeders;

use App\Models\CorrelativeType;
use App\Models\CorrelativeNumber;
use App\Models\Year;
use App\Models\Correlative;



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
    }
}
