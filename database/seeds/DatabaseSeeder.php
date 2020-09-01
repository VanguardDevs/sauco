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
        $this->call(AccountTypesTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(PaymentTypesTableSeeder::class);
        $this->call(ChargingMethodsTableSeeder::class);
        $this->call(OrdinancesTableSeeder::class);
        $this->call(CorrelativeTypesTableSeeder::class);
        $this->call(ListsTableSeeder::class);
        $this->call(ActivityClassificationsTableSeeder::class);
        $this->call(EconomicActivitiesTableSeeder::class);
        $this->call(CommunitiesTableSeeder::class); 
        $this->call(ParishesTableSeeder::class); 
        $this->call(CommunityParishTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TaxpayerClassificationsSeeder::class);
    }
}
