<?php

namespace app\Services;

use App\Payment;
use App\Services\SettlementService;
use App\Concept;

class FineService
{
    protected $settlement;

    public function __construct(SettlementService $settlement)
    {
        $this->settlement = $settlement;
    }

    public function create($settlement)
    {
        $amount = $this->calculateRechargue($settlement);
        $concept = Concept::whereCode(2)->first();

        $fine = $this->settlement->create(
            $settlement->taxpayer,
            $concept,
            $settlement->month,
            $amount,
            2 // State
        );

        return $fine;
    }

    public function calculateRechargue($settlement)
    {
        $concept = $settlement->concept;

        return $settlement->amount * 0.6;
    }
}

