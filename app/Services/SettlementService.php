<?php

namespace App\Services;

use App\Concept;
use App\Settlement;
use App\Taxpayer;
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
    public function make(Taxpayer $taxpayer, Concept $concept)
    {
        $settlement = $this->create($taxpayer, $concept);
        $code = $concept->code;

        if ($code == 1) {
            $this->activitySettlement->make($settlement);
        }
    }

    /**
     * Handle updates
     * @param Settlement $settlement,  array $data
     */
    public function handleUpdate($settlement, $data)
    {
        $totalAmount = $this->activitySettlement->update($settlement, $data);
        $settlement = $this->update($settlement, [
            'amount' => $totalAmount,
            'state_id' => 2
        ]);

        return $settlement;
    }


    /**
     * Creates an economic activity settlement for a given taxpayer
     * @param Taxpayer $taxpayer
     */
    public function create($taxpayer, $concept)
    {
        $settlement = Settlement::create([
            'amount' => "0.00",
            'taxpayer_id' => $taxpayer->id,
            'month_id' => 1,
            'state_id' => 1,
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

