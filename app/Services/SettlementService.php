<?php

namespace App\Services;

use App\Concept;
use App\Affidavit;
use App\Taxpayer;
use App\Month;
use Carbon\Carbon;
use App\Services\AffidavitService;

class SettlementService
{
    /**
     * @var Settlement Model
     */
    public function __construct(AffidavitService $economicActivityAffidavit)
    {
        $this->economicActivityAffidavit = $economicActivityAffidavit;
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
     * @param Settlement $affidavit,  array $data
     */
    public function handleUpdate($affidavit, $data, $byGroup)
    {
        if ($byGroup) {
            $totalAmount = $this->economicActivityAffidavit->updateByGroup($affidavit, $data);          } else {
            $totalAmount = $this->economicActivityAffidavit->update($affidavit, $data);
        }


        $affidavit = $this->update($settlement, [
            'amount' => $totalAmount,
            'state_id' => 2,
            'user_id' => auth()->user()->id,
            'processed_at' => $processedAt,
        ]);

        return $affidavit;
    }

    /**
     * Update affidavit for a given taxpayer
     * @param Settlement $affidavit, array $data
     */
    public function update($affidavit, array $data)
    {
        $affidavit = Affidavit::find($affidavit->id);
        $affidavit->update($data);

        return $affidavit;
    }
}

