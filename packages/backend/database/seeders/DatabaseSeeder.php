<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(TaxpayerTypeSeeder::class);
        $this->call(TaxpayerClassificationSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(LiquidationTypesSeeder::class);
        $this->call(OrdinancesSeeder::class);
        $this->call(ChargingMethodsSeeder::class);
        $this->call(IntervalsSeeder::class);
        $this->call(AccountingAccountsSeeder::class);
        $this->call(CancellationTypesSeeder::class);
        // $this->call(BrandTableSeeder::class);
        // $this->call(ColorTableSeeder::class);
        // $this->call(ModelTableSeeder::class);
        // $this->call(AnnexSeeder::class);
        // $this->call(VehicleParameterSeeder::class);

        // Testing
        if (App::environment() == 'local') {
            $this->call(ConceptsSeeder::class);
            $this->call(UserSeeder::class);
            $this->call(PaymentTypeSeeder::class);
            $this->call(PaymentMethodSeeder::class);
            $this->call(RepresentationTypeSeeder::class);
            $this->call(GeographicAreaSeeder::class);
            $this->call(SettingsSeeder::class);
            // $this->call(DevEnvironmentSeeder::class);
        }

        $this->call(AdminSeeder::class);
    }
}
