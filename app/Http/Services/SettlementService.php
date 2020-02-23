<?php

namespace App\Services;

use App\EconomicActivitySettlement;
use App\Concept;
use App\Settlement;
use App\Taxpayer;
use App\Month;
use App\Ordinance;
use App\Payment;
use Carbon\Carbon;
use App\Http\Traits\NumberTrait;

class SettlementService {
    public function makeSettlements(Taxpayer $taxpayer, Payment $payment)
    {
        $ordinance = Ordinance::whereDescription('ACTIVIDAD ECONÓMICA')->first();

        if ($ordinance->description == 'ACTIVIDAD ECONÓMICA') {
            return $this->economicActivitySettlements($taxpayer, $payment);
        }
    }

    private function storePendingSettlement($taxpayer, $payment, $concept)
    {
        $month = Month::find(Carbon::now()->month - 1);
        /**
         * Return a new settlement (not processed yet)
         */
        $settlementNum = Settlement::getNum();
            
        $settlement = Settlement::create([
           'num' => $settlementNum,
           'amount' => 0.0,
           'concept_id' => $concept->id,
           'month_id' => $month->id,
           'taxpayer_id' => $taxpayer->id
        ]);

        return $settlement; 
    }

    public function calculateSettlements(Taxpayer $taxpayer)
    {
        // According to its type, determine when was the last time a taxpayer
        // Received a settlement and generate N settlements per month.
    }

    protected function economicActivitySettlements(Taxpayer $taxpayer)
    {
        /**
         * Check economic activity license status first calling Services\License
         */
        $concept = Concept::whereCode(1)->first();
        $settlement = $this->storePendingSettlement($taxpayer, $payment, $concept);

        foreach ($taxpayer->economicActivities as $activity) { 
            EconomicActivitySettlement::create([
                'economic_activity_id' => $activity->id,
                'settlement_id' => $settlement->id,
                'amount' => $amount
            ]); 
        }
    }
}
