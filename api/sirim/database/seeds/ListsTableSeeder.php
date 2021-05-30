<?php

use Illuminate\Database\Seeder;
use App\Listing;

class ListsTableSeeder extends Seeder
{
    protected $lists = Array(
        'SOLICITUDES', 'MULTAS', 'LIQUIDACIONES'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->lists as $value) {
            Listing::create([
                'name' => $value
            ]);
        }
    }
}
