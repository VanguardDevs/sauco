<?php

use App\OrdinanceType;
use Illuminate\Database\Seeder;

class OrdinanceTypesTableSeeder extends Seeder
{
    private $types = Array(
        'SOLICITUDES',
        'SANCIONES'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->types as $key => $value) {
            OrdinanceType::create([
                'description' => $value
            ]);
        }
    }
}
