<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    protected $states = Array(
        'Pendiente', 'Procesado', 'Anulado', 'Confirmado' 
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
