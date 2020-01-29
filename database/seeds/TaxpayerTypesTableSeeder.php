<?php

use App\TaxpayerType;
use Illuminate\Database\Seeder;

class TaxpayerTypesTableSeeder extends Seeder
{
    private $types = Array(
        'JURÍDICO', // IF CHANGE, MODIFY SCRIPTS.JS
        'NATURAL',
        'EXTRANJERO',
        'GUBERNAMENTAL'
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
                'description' => $value
            ]);
        }
    }
}
