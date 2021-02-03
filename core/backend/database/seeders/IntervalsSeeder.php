<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interval;

class IntervalsSeeder extends Seeder
{
    protected $names = [
        'Diario',
        'Quincenal',
        'Mensual',
        'Bimestral',
        'Trimestral',
        'Semestral',
        'Anual'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->names as $name) {
            Interval::create([
                'name' => $name
            ]);
        }
    }
}
