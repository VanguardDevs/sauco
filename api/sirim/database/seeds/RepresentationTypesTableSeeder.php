<?php

use App\RepresentationType;
use Illuminate\Database\Seeder;

class RepresentationTypesTableSeeder extends Seeder
{
    protected $types = [
        'GESTOR', 'PRESIDENTE', 'SOCIO'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->types as $key => $value) {
            RepresentationType::create([
                'name' => $value
            ]);
        }
    }
}
