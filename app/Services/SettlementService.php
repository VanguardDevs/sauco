<?php

namespace App\Services;

use App\Concept;
use App\Settlement;
use App\Taxpayer;
use App\Month;
use Carbon\Carbon;
use App\Services\AffidavitService;

class SettlementService
{
    /**
     * @var Settlement Model
     */
    public function __construct(AffidavitService $affidavit)
    {
        $this->affidavit = $affidavit;
    }
    
    /**
     * Return a settlement for a given concept and taxpayer
     * @param $concept, $taxpayer
     */
    public function find($concept, $taxpayer)
    {
        return Settlement::whereConceptId($concept->id)
            ->whereTaxpayerId($taxpayer->id);
    }

    /**
     * Return a settlement for a given month, taxpayer and concept
     * @param $concept, $taxpayer, $month
     */
    public function findOneByMonth($concept, $taxpayer, $month)
    {
        return $this->find($concept, $taxpayer)
            ->whereMonthId($month->id)
            ->first();
    }

    /**
     * Handle all settlements
     * @param Taxpayer $taxpayer, Concept $concept
     */
    public function make(Taxpayer $taxpayer, Concept $concept, Month $month)
    {
        $code = $concept->code;

        if ($code == 1) {
            $settlement = $this->create($taxpayer, $concept, $month);
            $this->affidavit->make($settlement);
        }

        return $settlement;
    }

    public function message($concept, $month)
    {
        if ($concept->code == 1) {
            return $concept->name.': '.$month->name.' - '.$month->year->year;
        }

        return $concept->name;
    }

    /**
     * Handle updates
     * @param Settlement $settlement,  array $data
     */
    public function handleUpdate($settlement, $data, $byGroup)
    {
        if ($byGroup) {
            $totalAmount = $this->affidavit->updateByGroup($settlement, $data);    
        } else {
            $totalAmount = $this->affidavit->update($settlement, $data);
        }

        $settlementNum = Settlement::newNum();
        $processedAt = Carbon::now();

        $settlement = $this->update($settlement, [
            'amount' => $totalAmount,
            'state_id' => 2,
            'user_id' => auth()->user()->id,
            'processed_at' => $processedAt,
            'num' => $settlementNum
        ]);

        return $settlement;
    }

    /**
     * Creates an economic activity settlement for a given taxpayer
     * @param Taxpayer $taxpayer
     */
    public function create($taxpayer, $concept, $month, $amount = 0.00, $state = 1)
    {
        $objectSettlement = $this->message($concept, $month);

        $settlement = Settlement::create([
            'object_payment' => $objectSettlement,
            'amount' => $amount,
            'taxpayer_id' => $taxpayer->id,
            'month_id' => $month->id,
            'state_id' => $state,
            'user_id' => auth()->user()->id,
            'concept_id' => $concept->id,
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

