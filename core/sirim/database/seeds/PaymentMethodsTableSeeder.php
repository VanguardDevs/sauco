<?php

use Illuminate\Database\Seeder;
use App\PaymentMethod;

class PaymentMethodsTableSeeder extends Seeder
{
    protected $methods = Array(
        'S/N', 'TRANSFERENCIA', 'EFECTIVO',
        'DÉBITO', 'CRÉDITO', 'DEPÓSITO'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->methods as $key => $value) {
            PaymentMethod::create([
                'name' => $value
            ]);
        }
    }
}
