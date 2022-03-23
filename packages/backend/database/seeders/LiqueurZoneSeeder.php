<?php

namespace Database\Seeders;

use App\Models\LiqueurZone;
use Illuminate\Database\Seeder;

class LiqueurZoneSeeder extends Seeder
{

    public $liqueurzones = Array(
        "Urbana",
        "Sub Urbana"
    );
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->liqueurzones as $key => $liqueurzone) {
            LiqueurZone::create([
                'name' => $liqueurzone
            ]);
        }
    }
}
