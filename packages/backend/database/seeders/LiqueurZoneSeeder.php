<?php

use Illuminate\Database\Seeder;
use App\Models\LiqueurZone;

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
