<?php

namespace Database\Seeders;

use App\Models\ChargingMethod;
use Illuminate\Database\Seeder;

class ChargingMethodsSeeder extends Seeder
{
    protected $methods = Array(
        'U.T', 'TASA', 'DIVISA'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->methods as $key => $value) {
            ChargingMethod::create([
                'name' => $value
            ]);
        }
    }
}
