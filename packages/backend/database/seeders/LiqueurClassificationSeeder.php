<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LiqueurClassificationSeeder extends Seeder
{
    protected $rows = Array(
        ["Al por Mayor", "MY", '000202'],
        ["Al por Menor", "MN", '000334'],
        ["Cantinas", "C", '000153'],
        ["Cervezas y Vinos Naturales Nacionales", "CV", '00008'],
        ["Pequeños Expendios de Cervezas", "PEC", '000009'],
        ["Cerveza por Copas / Cerveza sola", "Cc", '000019']
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
                'abbreviature' => $row[1],
                'correlative' => $row[2]
            ]);
        }
    }
}
