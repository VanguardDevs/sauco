<?php

use App\PaymentState;
use Illuminate\Database\Seeder;

class PaymentStatesTableSeeder extends Seeder
{
    protected $states = Array(
        'PENDIENTE', 'PROCESADA', 'PAGADA'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->states as $key => $value) {
            PaymentState::create([
                'description' => $value
            ]);
        }
    }
}
