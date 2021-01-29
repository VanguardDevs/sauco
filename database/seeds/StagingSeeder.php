<?php

use Illuminate\Database\Seeder;

class StagingSeeder extends Seeder
{
    // Table names must be equals between db's
    protected $tableNames = Array(
        'communities',
        'community_parish',
        'economic_sectors',
        'taxpayers', 
        'economic_activities',
        'economic_activity_taxpayer',
        'commercial_denominations',
        'people',
        'representations',
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prod_db = DB::connection('pgsql_staging');

        foreach($this->tableNames as $name) {
            // Get table data from production and insert in local db            
            foreach($prod_db->table($name)->get() as $data) {
                DB::table($name)->insert((array) $data);
            }
        }
    }
}
