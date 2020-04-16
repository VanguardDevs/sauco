<?php

namespace app\Services;

use App\Payment;
use App\PaymentType;
use App\Reference;
use App\PaymentMethod;
use Carbon\Carbon;

class PaymentService
{
    protected $method;
    protected $type;

    public function __construct(PaymentType $type, PaymentMethod $method)
    {
        $this->type = $type;
        $this->method = $method;
    }

    public function update(Payment $payment, Array $data)
    {
        $paymentNum = Payment::newNum();
        $processedAt = Carbon::now();

        $data += [
            'state_id' => 2,
            'payment_type_id' => 2,
            'num' => $paymentNum,
            'processed_at' => $processedAt
        ];
        $payment->update($data);
    }

    public function makeReference(Payment $payment, string $referenceNum)
    {
        $reference = Reference::create([
            'reference' => $referenceNum,
            'account_id' => 1, // For later use, select account
            'payment_id' => $payment->id
        ]);
        
        return $reference;
    } 
}

