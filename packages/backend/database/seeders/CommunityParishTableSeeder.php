<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommunityParishTableSeeder extends Seeder
{
    protected $rows = Array(
        [1, 3],
        [1, 4],
        [2, 3],
        [3, 1],
        [4, 1],
        [5, 1],
        [6, 1],
        [7, 1],
        [8, 1],
        [9, 1],
        [10, 1],
        [11, 1],
        [12, 1],
        [13, 1],
        [14, 1],
        [15, 2],
        [16, 2],
        [17, 2],
        [18, 3],
        [19, 3],
        [20, 3],
        [21, 3],
        [22, 3],
        [23, 3],
        [24, 3],
        [25, 3],
        [26, 3],
        [27, 3],
        [28, 3],
        [29, 3],
        [30, 3],
        [31, 3],
        [32, 3],
        [33, 3],
        [34, 3],
        [35, 3],
        [36, 3],
        [37, 3],
        [38, 3],
        [39, 3],
        [40, 4],
        [41, 4],
        [42, 4],
        [43, 5],
        [44, 4],
        [45, 4],
        [46, 4],
        [47, 3],
        [48, 4],
        [49, 5],
        [50, 5]
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->rows as $row) {
            DB::table('community_parish')->insert([
                'community_id' => $row[0],
                'parish_id' => $row[1]
            ]);
        }
    }
}
