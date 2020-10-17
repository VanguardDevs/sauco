<?php

namespace Database\Seeders;

use App\RepresentationType;
use Illuminate\Database\Seeder;

class RepresentationTypesSeeder extends Seeder
{
    protected $types = [
        'Gestor',
        'Presidente',
        'Contador',
        'Socio'
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
