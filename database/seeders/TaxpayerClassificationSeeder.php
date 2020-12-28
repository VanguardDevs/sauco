<?php

namespace Database\Seeders;

use App\Models\TaxpayerClassification;
use Illuminate\Database\Seeder;

class TaxpayerClassificationSeeder extends Seeder
{
    protected $classifications = Array(
        'ORDINARIO', 'FORMAL', 'ESPECIAL'
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
