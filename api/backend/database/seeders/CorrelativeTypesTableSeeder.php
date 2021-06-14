<?php

use App\CorrelativeType;
use Illuminate\Database\Seeder;

class CorrelativeTypesTableSeeder extends Seeder
{
    protected $types = Array(
        'I-', 'R-'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->types as $key => $value) {
            CorrelativeType::create([
                'description' => $value
            ]);
        }
    }
}
