<?php

use App\AccountType;
use Illuminate\Database\Seeder;

class AccountTypesTableSeeder extends Seeder
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
            AccountType::create([
                'denomination' => $value
            ]);
        }
    }
}
