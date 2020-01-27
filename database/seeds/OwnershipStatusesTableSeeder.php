<?php

use App\OwnershipStatus;
use Illuminate\Database\Seeder;

class OwnershipStatusesTableSeeder extends Seeder
{
    private $statuses = Array(
        'ALQUILADO', 'PROPIO'
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
                'description' => $value
            ]);
        }
    }
}
