<?php

use App\ChargingMethod;
use Illuminate\Database\Seeder;

class ChargingMethodsTableSeeder extends Seeder
{
    private $methods = Array(
        'U.T', 'PETRO', 'TASA', 'BS'
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
