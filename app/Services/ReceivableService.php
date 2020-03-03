<?php

namespace app\Services;

use App\Settlement;
use App\Receivable;
use App\Payment;

class ReceivableService
{
    public function make(Settlement $settlement, Payment $payment)
    {
        $month = $settlement->month;
        $date = $month->name.' - '.$month->year->year;
        $object = $settlement->concept->name.' '.$date;

        $receivable = Receivable::create([
            'object_payment' => $object, 
            'settlement_id' => $settlement->id,
            'payment_id' => $payment->id
        ]);
        
        $payment->update([
            'amount' => $settlement->amount
        ]);
 

        return $receivable;
    }
}

