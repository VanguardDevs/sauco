<?php

namespace Database\Seeders;

use App\TaxpayerClassification;
use Illuminate\Database\Seeder;

class TaxpayerClassificationsSeeder extends Seeder
{
    protected $classifications = Array(
        'Ordinario', 'Formal', 'Especial'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->classifications as $classification) {
            TaxpayerClassification::create([
                'name' => $classification
            ]);
        }
    }
}
