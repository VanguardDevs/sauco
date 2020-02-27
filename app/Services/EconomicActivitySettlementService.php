<?php

namespace App\Services;

use App\EconomicActivitySettlement;
use App\Settlement;

class EconomicActivitySettlementService extends ModelService 
{
    protected $model;

    public function __construct(EconomicActivitySettlement $model)
    {
        $this->model = $model;
    }
    
    /**
     * Create economic activity settlements for every activity
     * @param $settlement
     */
    public function make(Settlement $settlement)
    {
        $activities = $settlement->taxpayer->economicActivities;
        $data = Array();
        
        $nums = $this->getNums(count($activities));
        
        foreach($activities as $activity) {
            array_push($data, Array(
                'num' => array_shift($nums), 
                'amount' => 0.00,
                'settlement_id' => $settlement->id,
                'economic_activity_id' => $activity->id
            ));
        }

        EconomicActivitySettlement::insert($data);
    }
}
