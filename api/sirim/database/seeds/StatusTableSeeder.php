<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    protected $states = Array(
        'PENDIENTE', 'PROCESADA' 
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->states as $key => $value) {
            Status::create([
                'name' => $value
            ]);
        }
    }
}
