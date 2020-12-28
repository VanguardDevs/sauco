<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentType;

class PaymentTypeSeeder extends Seeder
{
    protected $types = Array(
        'Divisa', 'Débito', 'Crédito', 'Depósito'
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
