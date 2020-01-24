<?php

use App\ApplicationState;
use Illuminate\Database\Seeder;

class ApplicationStatesTableSeeder extends Seeder
{
    private $types = Array(
        'PENDIENTE', 'APROBADA'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->types as $key => $value) {
            ApplicationState::create([
                'description' => $value
            ]);
        }
    }
}
