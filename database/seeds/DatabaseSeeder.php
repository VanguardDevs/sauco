<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(ParishesTableSeeder::class);
        $this->call(CitizenshipsTableSeeder::class);
        $this->call(TaxpayerTypesTableSeeder::class);
        $this->call(BankAccountTypesTableSeeder::class);
        $this->call(LicenseStatesTableSeeder::class);
        $this->call(OwnershipStatusesTableSeeder::class);
        $this->call(PaymentStatesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(MunicipalitiesTableSeeder::class);
        $this->call(EconomicSectorsTableSeeder::class);
        $this->call(ChargingMethodsTableSeeder::class);
        $this->call(OrdinanceTypesTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
    }
}
