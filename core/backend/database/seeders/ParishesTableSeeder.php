<?php

use App\Parish;
use Illuminate\Database\Seeder;

class ParishesTableSeeder extends Seeder
{
    public $parishes = Array(
        'BOLÍVAR',
        'MACARAPANA',
        'SANTA CATALINA',
        'SANTA ROSA',
        'SANTA TERESA'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->parishes as $key => $parish) {
            Parish::create([
                'name' => $parish
            ]);
        }
    }
}
