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
     * Creates a new num from last model
     * @return str
     */ 
    public function getNewNum()
    {
        $id = 1;
        $lastModel = $this->model->withTrashed()->latest()->first();

        if ($lastModel) {
            $id = strval($lastModel->id + 1);
        }

        $num = str_pad($id, 8, "0", STR_PAD_LEFT);

        return $num;
    }

    /**
     * Creates an economic activity settlement for a given taxpayer
     * @param Taxpayer $taxpayer
     */
    public function create(Taxpayer $taxpayer)
    {
        $num = $this->getNewNum();

        $settlement = Settlement::create([
            'num' => $num,
            'amount' => 0.00,
            'taxpayer_id' => $taxpayer->id,
            'month_id' => 1,
            'state_id' => 1,
            'concept_id' => $this->concept->id
        ]);

        return $settlement;
    }
}

