<?php

use App\ApplicationState;
use Illuminate\Database\Seeder;

class ApplicationStatesTableSeeder extends Seeder
{
    protected $states = Array(
        'APROBADA', 'DENEGADA', 'PENDIENTE'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->states as $key => $value) {
            ApplicationState::create([
                'description' => $value
            ]);
        }
    }
}
