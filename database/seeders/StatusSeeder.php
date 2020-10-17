<?php

namespace Database\Seeders;

use App\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    protected $states = Array(
        'Pendiente',
        'Aprobado',
        'Por confirmar',
        'Anulado',
        'Procesado' 
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
