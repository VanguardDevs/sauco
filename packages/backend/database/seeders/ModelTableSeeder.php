<?php

namespace Database\Seeders;

use App\Model\VehicleModel;
use Illuminate\Database\Seeder;

class ModelTableSeeder extends Seeder
{
    public $models = Array(

    );
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->models as $key => $model) {
            Color::create([
                'name' => $model
            ]);
        }
    }
}
