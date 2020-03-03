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
                'brute_amount' => 0.00,
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

    public function updateByGroup(Settlement $settlement, float $amount)
    {
        $settlements = $settlement->economicActivitySettlements;
        $max = $settlements->first();

        if ($amount == 0.00) {
            foreach ($settlements as $settlement) {
                if ($settlement->economicActivity->min_tax > $max->economicActivity->min_tax) {
                    $max = $settlement;
                }
            }
        } else {
            foreach ($settlements as $settlement) {
                if ($settlement->economicActivity->aliquote > $max->economicActivity->aliquote) {
                    $max = $settlement;
                }
            }
        }
        
        return $this->calculateTax($settlement, $amount)->amount;
    }

    public function calculateTax(EconomicActivitySettlement $activitySettlement, $amount)
    {
        $activity = $activitySettlement->economicActivity;
        $taxUnit = TaxUnit::latest()->first();
        $total = $activity->min_tax * $taxUnit->value;
        
        if ($amount > $total && $amount != 0.00) {
            $total = $amount * $activity->aliquote / 100;
        }
        
        $settlement = EconomicActivitySettlement::find($activitySettlement->id);
        $settlement->update([
            'amount' => $total,
            'brute_amount' => $amount
        ]);
        return $settlement;
    }
}
