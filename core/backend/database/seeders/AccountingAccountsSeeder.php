<?php

namespace Database\Seeders;

use App\Models\AccountingAccount;
use Illuminate\Database\Seeder;

class AccountingAccountsSeeder extends Seeder
{
    protected $names = [
        'Registro civil',
        'Venta de Tierras y Terrenos',
        'Apuestas Lícitas',
        'Solvencias',
        'Multas y Recargos'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->names as $name) {
            AccountingAccount::create([
                'name' => $name
            ]);
        }
    }
}
