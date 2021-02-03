<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Concept;

class ConceptsSeeder extends Seeder
{
    private $concepts = [
        [
            'code' => '000001',
            'name' => 'Liquidación a la Act. Econó.',
            'min_amount' => '0',
            'max_amount' => '0',
            'charging_method_id' => 1,
            'liquidation_type_id' => 1,
            'ordinance_id' => 1,
            'interval_id' => 1,
            'accounting_account_id' => 1
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->concepts as $concept) {
            Concept::create($concept);
        }
    }
}
