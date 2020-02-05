<?php

use Illuminate\Database\Seeder;
use App\PaymentType;

class PaymentTypesTableSeeder extends Seeder
{
    protected $types = Array(
        'TRANSFERENCIA', 'EFECTIVO',
        'DÉBITO', 'CRÉDITO', 'DEPÓSITO'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->types as $key => $value) {
            PaymentType::create([
                'description' => $value
            ]);
        }
    }
}
