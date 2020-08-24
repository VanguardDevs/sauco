<?php

use App\TaxpayerType;
use Illuminate\Database\Seeder;

class TaxpayerTypesTableSeeder extends Seeder
{
    private $types = Array(
        'JURÍDICO' => 'J-',
        'NATURAL' => 'N-',
        'EXTRANJERO' => 'E-',
        'GUBERNAMENTAL' => 'G-'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->types as $key => $value) {
            TaxpayerType::create([
                'description' => $key,
                'correlative' => $value
            ]);
        }
    }
}
