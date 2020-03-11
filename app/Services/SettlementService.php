<?php

namespace App\Services;

use App\Concept;
use App\Settlement;
use App\Taxpayer;
use App\Month;
use App\Services\EconomicActivitySettlementService;

class SettlementService
{
    /**
     * @var Settlement Model
     */
    public function __construct(EconomicActivitySettlementService $activitySettlement)
    {
        $this->activitySettlement = $activitySettlement;
    }

    /**
     * Handle all settlements
     * @param Taxpayer $taxpayer, Concept $concept
     */
    public function make(Taxpayer $taxpayer, Concept $concept, Month $month)
    {
        $settlement = $this->create($taxpayer, $concept, $month);
        $code = $concept->code;

        if ($code == 1) {
            $this->activitySettlement->make($settlement);
        }
    }

    /**
     * Handle updates
     * @param Settlement $settlement,  array $data
     */
    public function handleUpdate($settlement, $data, $byGroup)
    {
        if ($byGroup) {
            $totalAmount = $this->activitySettlement->updateByGroup($settlement, $data);    
        } else {
            $totalAmount = $this->activitySettlement->update($settlement, $data);
        }

        $settlement = $this->update($settlement, [
            'amount' => $totalAmount,
            'state_id' => 2,
            'user_id' => auth()->user()->id
        ]);

        return $settlement;
    }


    /**
     * Creates an economic activity settlement for a given taxpayer
     * @param Taxpayer $taxpayer
     */
    public function create($taxpayer, $concept, $month)
    {
        $settlement = Settlement::create([
            'amount' => 0.00,
            'taxpayer_id' => $taxpayer->id,
            'month_id' => $month->id,
            'state_id' => 1,
            'user_id' => auth()->user()->id,
            'concept_id' => $concept->id
        ]);

        return $settlement;
    }

    /**
     * Update settlement for a given taxpayer
     * @param Settlement $settlement, array $data
     */
    public function update($settlement, array $data)
    {
        $settlement = Settlement::find($settlement->id);
        $settlement->update($data);

        return $settlement;
    }
}

