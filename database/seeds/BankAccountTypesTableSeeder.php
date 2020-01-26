<?php

use App\BankAccountType;
use Illuminate\Database\Seeder;

class BankAccountTypesTableSeeder extends Seeder
{
    public $types = Array(
        'CORRIENTE', 'AHORRO'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->types as $key => $value) {
            BankAccountType::create([
                'denomination' => $value
            ]);
        }
    }
}
