<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LiqueurClassificationSeeder extends Seeder
{
    protected $rows = Array(

        ["Al por Mayor", "MY"],
        ["Al por Menor", "MN"],
        ["Cantinas", "C"],
        ["Cervezas y Vinos Naturales Nacionales", "CV"],
        ["Pequeños Expendios de Cervezas", "PEC"],
        ["Cerveza por Copas / Cerveza sola", "Cc"]
    );
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->rows as $row) {
            DB::table('liqueur_classifications')->insert([
                'name' => $row[0],
                'abbreviature' => $row[1]
            ]);
        }
    }
}
