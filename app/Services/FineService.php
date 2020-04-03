<?php

namespace app\Services;

use App\Payment;
use App\Concept;
use App\Settlement;

class FineService
{
    protected $settlement;    
    
    public function create($settlement, $concept_id)
    {
        $concept = Concept::find($concept_id);
        $amount = $this->calculateRechargue($settlement, $concept);

        $message = $concept->name;

        $fine = Settlement::create([
            'num' => Settlement::newNum(),
            'object_payment' => $message,
            'amount' => $amount,
            'taxpayer_id' => $settlement->taxpayer->id,
            'month_id' => 12,
            'state_id' => 2,
            'user_id' => auth()->user()->id,
            'concept_id' => $concept->id
        ]);

        return $fine;
    }

    public function calculateRechargue($settlement, $concept)
    {
        if ($concept->code == 2) {
            return $settlement->amount * 0.6;
        }
        return $settlement->amount * 0.3;
    }
}

