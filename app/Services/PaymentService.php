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

    /**
    * Make a pending payment
    * @param var $objectPayment
    */    
    public function make()
    {
        $payment = Payment::create([
            'state_id' => 1,
            'amount' => 0.0,
            'payment_method_id' => 1,
            'payment_type_id' => 1,
        ]);

        return $payment;
    }

    public function updateAmount($payment)
    {
        $totalAmount = $payment->settlements->sum('amount');

        $payment->update(['amount' => $totalAmount]);
    }

    public function update(Payment $payment, Array $data)
    {
        $paymentNum = $this->newNum();
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

    private function newNum()
    {
        $lastNum = Payment::withTrashed()
            ->whereStateId(2)
            ->orderBy('processed_at', 'DESC')
            ->first()
            ->num;

        $newNum = str_pad($lastNum + 1, 8, '0', STR_PAD_LEFT);
        return $newNum;
    }
}

