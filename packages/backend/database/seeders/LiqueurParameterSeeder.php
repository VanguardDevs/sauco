<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LiqueurParameterSeeder extends Seeder
{

    protected $rows = Array(
        ["1", "Expendios de Bebidas Alchólicas en Zonas Urbanas", "0.1", "0.3", "1", false, null, "1", "2"],
        ["2", "Expendios de Bebidas Alchólicas en Zonas Sub Urbanas", "0.1", "0.3", "0.5", false, null, "2", "2"],
        ["3", "Pequeños Expendios de Cervezas en Zonas Urbanas", "0.1", "0.3", "0.25", false, "5", "1", "2"],
        ["4", "Pequeños Expendios de Cervezas en Zonas Sub Urbanas", "0.1", "0.3", "0.5", false, "5", "2", "2"],
        ["5", "Franquicias Móviles", "0.1", "0.3", "0.5", true, "1", "1", "2"]
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->rows as $row) {
            DB::table('liqueur_parameters')->insert([
                'id' => $row[0],
                'description' => $row[1],
                'new_registry_amount' => $row[2],
                'renew_registry_amount' => $row[3],
                'authorization_registry_amount' => $row[4],
                'is_mobile' => $row[5],
                'liqueur_classification_id' => $row[6],
                'liqueur_zone_id' => $row[7],
                'charging_method_id' => $row[8]
            ]);
        }
    }
}
