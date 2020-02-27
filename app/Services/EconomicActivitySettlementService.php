<?php

namespace App\Services;

use App\EconomicActivitySettlement;
use App\Settlement;

class EconomicActivitySettlementService
{
    /**
     * Create economic activity settlements for every activity
     * @param $settlement
     */
    public function make(Settlement $settlement)
    {
        $activities = $settlement->taxpayer->economicActivities;
        $data = Array();
        
        foreach($activities as $activity) {
            array_push($data, Array(
                'amount' => 0.00,
                'settlement_id' => $settlement->id,
                'economic_activity_id' => $activity->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ));
        }

        EconomicActivitySettlement::insert($data);
    }
}
