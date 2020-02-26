<?php

namespace App\Services;

use App\Concept;
use App\Settlement;
use App\EconomicActivitySettlement;
use App\Taxpayer;

class SettlementService 
{
    /**
     * @var Settlement Model
     */
    protected $model;

    public function __construct(Settlement $model, Concept $concept)
    {
        $this->model = $model;
        $this->concept = $concept->whereCode('1')->first();
    }

    /**
     * Creates an economic activity settlement for a given taxpayer
     * @param Taxpayer $taxpayer
     */
    public function create(Taxpayer $taxpayer)
    {
        $settlement = Settlement::create([
            'num' => '00000001',
            'amount' => 0.00,
            'taxpayer_id' => $taxpayer->id,
            'month_id' => 1,
            'state_id' => 1,
            'concept_id' => $this->concept->id
        ]);

        return $settlement;
    }
}

