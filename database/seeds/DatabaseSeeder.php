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
        $this->call(OwnershipStatesTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(PaymentTypesTableSeeder::class);
        $this->call(ChargingMethodsTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(OrdinancesTableSeeder::class);
        $this->call(CorrelativeTypesTableSeeder::class);
        $this->call(ListsTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);
/*        
        // For database's migration
        if (app('env') == "staging") {
            $this->call(StagingSeeder::class);
        } else {
            $this->call(EconomicSectorsTableSeeder::class);
            $this->call(EconomicActivitiesTableSeeder::class);
            $this->call(CommunitiesTableSeeder::class); 
            $this->call(CommunityParishTableSeeder::class);
        }
 */
    }
}
