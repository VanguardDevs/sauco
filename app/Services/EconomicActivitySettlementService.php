<?php

namespace App\Services;

use App\EconomicActivitySettlement;
use App\Settlement;
use App\TaxUnit;

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

    public function update(Settlement $settlement, array $amounts)
    {
        $settlements = $settlement->economicActivitySettlements;
        $bruteAmounts = $amounts;
        $totalAmounts = Array();

        foreach($settlements as $settlement) {
            $amount = array_shift($bruteAmounts);
            $updateSettlement = $this->calculateTax($settlement, $amount);
            array_push($totalAmounts, $updateSettlement->amount);
        }
        
        return array_sum($totalAmounts);
    }

    public function calculateTax(EconomicActivitySettlement $activitySettlement, $amount)
    {
        $activity = $activitySettlement->economicActivity;
        $taxUnit = TaxUnit::latest()->first();
        $total = $activity->min_tax * $taxUnit->value;
        
        if ($amount > $total) {
            $total = $amount * $activity->aliquote;
        }

        $total = round($total, 2);

        $settlement = EconomicActivitySettlement::find($activitySettlement->id);
        $settlement->update([
            'amount' => $total
        ]);
        return $settlement;
    }
}
