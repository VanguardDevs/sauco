<?php

namespace app\Services;

use App\Settlement;
use App\Receivable;
use App\Payment;
use App\Services\FineService;
use App\Services\PaymentService;

class ReceivableService
{
    protected $fine;
    protected $payment;

    public function __construct(FineService $fine, PaymentService $payment)
    {
        $this->fine = $fine;
        $this->payment = $payment;
    }

    public function make(Settlement $settlement, Payment $payment)
    {
        $this->create($settlement, $payment); 

        // create fine if needed
        $this->createFine($settlement, $payment);
        // Then update amounts
        $this->payment->updateAmount($payment);
    }

    public function create($settlement, $payment)
    {
        $receivable = Receivable::create([
            'settlement_id' => $settlement->id,
            'payment_id' => $payment->id
        ]);

        return $receivable;
    }

    public function createFine($settlement, $payment)
    {
        if ($settlement->month->year->year != 2020) {
            $fine = $this->fine->create($settlement);
            $this->create($fine, $payment);
        }
    }
}

