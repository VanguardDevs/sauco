<?php

namespace Database\Seeders;

use App\Models\RepresentationType;
use Illuminate\Database\Seeder;

class RepresentationTypeSeeder extends Seeder
{
    protected $types = [
        'Gestor', 'Presidente', 'Socio', 'Contador'
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
