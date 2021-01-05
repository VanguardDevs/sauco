<?php

namespace Database\Seeders;

use App\Models\TaxpayerType;
use Illuminate\Database\Seeder;

class TaxpayerTypeSeeder extends Seeder
{
    private $types = Array(
        'Jurídico' => 'J-',
        'Natural' => 'N-',
        'Extranjero' => 'E-',
        'Gubernamental' => 'G-'
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
