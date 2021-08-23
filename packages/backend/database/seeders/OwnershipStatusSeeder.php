<?php

namespace Database\Seeders;

use App\OwnershipStatus;
use Illuminate\Database\Seeder;

class OwnershipStatusSeeder extends Seeder
{
    private $statuses = Array(
        'Alquilado', 'Propio'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statuses as $key => $value) {
            OwnershipStatus::create([
                'name' => $value
            ]);
        }
    }
}
