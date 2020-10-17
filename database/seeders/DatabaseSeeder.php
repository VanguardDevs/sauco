<?php

namespace Database\Seeders;

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
        $this->call(StatusSeeder::class);
        $this->call(TaxpayerTypesSeeder::class);
        $this->call(TaxpayerClassificationsSeeder::class);
        $this->call(OrdinancesSeeder::class);
        $this->call(LiquidationTypesSeeder::class);
        $this->call(OwnershipStatusSeeder::class);
        $this->call(RepresentationTypesSeeder::class);
        /**
        $this->call(AccountTypesTableSeeder::class);
        $this->call(PaymentTypesTableSeeder::class);
        $this->call(ChargingMethodsTableSeeder::class);
        $this->call(CorrelativeTypesTableSeeder::class);
        $this->call(ActivityClassificationsTableSeeder::class);
        $this->call(EconomicActivitiesTableSeeder::class);
        $this->call(CommunitiesTableSeeder::class); 
        $this->call(ParishesTableSeeder::class); 
        $this->call(CommunityParishTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        **/
    }
}
