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
        $settlement = $this->create($taxpayer, $concept, $month);
        $code = $concept->code;
        
        if ($code == 1) {
            $this->affidavit->make($settlement);
        }

        return $settlement;
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

        $settlementNum = $this->newNum();
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
    public function create($taxpayer, $concept, $month)
    {
        $settlement = Settlement::create([
            'amount' => 0.00,
            'taxpayer_id' => $taxpayer->id,
            'month_id' => $month->id,
            'state_id' => 1,
            'user_id' => auth()->user()->id,
            'concept_id' => $concept->id,
        ]);

        return $settlement;
    }

    private function newNum()
    {
        $lastNum = Settlement::withTrashed()
            ->whereStateId(2)
            ->orderBy('processed_at', 'DESC')
            ->first()
            ->num;

        $newNum = str_pad($lastNum + 1, 8, '0', STR_PAD_LEFT);
        return $newNum;
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

