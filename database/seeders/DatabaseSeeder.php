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

        // Testing
        if (App::environment() == 'local') {
            $this->call(UserSeeder::class);
            $this->call(PaymentTypeSeeder::class);
            $this->call(PaymentMethodSeeder::class);
            $this->call(RepresentationTypeSeeder::class);
            $this->call(GeographicAreaSeeder::class);
        }

        if (App::environment() == 'production') {
            $this->call(AdminSeeder::class);
        }
    }
}
