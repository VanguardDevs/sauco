<?php

use App\Citizenship;
use Illuminate\Database\Seeder;

class CitizenshipsTableSeeder extends Seeder
{
    private $citizenships = Array(
        'VENEZOLANO' => 'V-',
        'EXTRANJERO' => 'E-'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->citizenships as $key => $value) {
            Citizenship::create([
                'description' => $key,
                'correlative' => $value
            ]);
        }
    }
}
