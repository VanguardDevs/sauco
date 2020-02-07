<?php

use App\ApplicationState;
use Illuminate\Database\Seeder;

class ApplicationStatesTableSeeder extends Seeder
{
    protected $states = Array(
        'APROBADA', 'DENEGADA'
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
