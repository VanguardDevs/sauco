<?php

namespace App\Traits;

use App\Models\Payment;

trait PaymentUtils
{
    public function payment()
    {
        if (!$this->liquidation()->exists()) {
            return null;
        }
        return $this->liquidation->payment;
    }

    public function mountPayment()
    {
        $payment = Payment::create([
            'status_id' => 1,
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'payment_method_id' => 1,
            'payment_type_id' => 1,
            'taxpayer_id' => $this->taxpayer_id
        ]);

        return $payment;
    }
}
