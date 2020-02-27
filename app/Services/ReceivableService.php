<?php

namespace app\Services;

use App\Settlement;
use App\Receivable;
use App\Payment;

class ReceivableService
{
    public function make(Settlement $settlement, Payment $payment)
    {
        $receivable = Receivable::create([
            'object_payment' => $settlement->concept->name, 
            'settlement_id' => $settlement->id,
            'payment_id' => $payment->id
        ]);

        return $receivable;
    }
}

