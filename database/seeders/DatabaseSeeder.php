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

        if (App::environment() == 'local') {
            $this->call(UserSeeder::class);
        }

        if (App::environment() == 'production') {
            $this->call(AdminSeeder::class);
        }
    }
}
