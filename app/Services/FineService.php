<?php

namespace app\Services;

use App\Payment;
use App\Concept;
use App\Settlement;

class FineService
{
    protected $settlement;    
    
    public function create($settlement)
    {
        $amount = $this->calculateRechargue($settlement);
        $concept = Concept::whereCode(2)->first();

        $message = $concept->name;

        $fine = Settlement::create([
            'num' => Settlement::newNum(),
            'object_payment' => $message,
            'amount' => $amount,
            'taxpayer_id' => $settlement->taxpayer->id,
            'month_id' => $settlement->month->id,
            'state_id' => 2,
            'user_id' => auth()->user()->id,
            'concept_id' => $concept->id
        ]);

        return $fine;
    }

    public function calculateRechargue($settlement)
    {
        $concept = $settlement->concept;

        return $settlement->amount * 0.6;
    }
}

