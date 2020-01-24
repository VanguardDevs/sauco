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
        $this->call(ApplicationStatesTableSeeder::class);
    }
}
