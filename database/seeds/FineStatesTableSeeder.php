<?php

use App\FineState;
use Illuminate\Database\Seeder;

class FineStatesTableSeeder extends Seeder
{
    private $states = Array(
        'PENDIENTE', 'PAGADA'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->states as $key => $value) {
            FineState::create([
                'description' => $value
            ]);
        }
    }
}
