<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    protected $methods = Array(
        'Transferencia', 'Efectivo',
        'Débito', 'Crédito', 'Depósito'
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
