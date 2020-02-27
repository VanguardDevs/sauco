<?php

namespace app\Services;

use App\Payment;
use App\PaymentType;
use App\PaymentMethod;

class PaymentService
{
    protected $method;
    protected $type;

    public function __construct(PaymentType $type, PaymentMethod $method)
    {
        $this->type = $type;
        $this->method = $method;
    }

    public function make()
    {
        $payment = Payment::create([
            'object_payment' => 'LIQUIDACIÓN POR IMPUESTO DE ACTIVIDAD ECONÓMICA',
            'state_id' => 1,
            'amount' => 0.0,
            'payment_method_id' => 1,
            'payment_type_id' => 1
        ]);

        return $payment;
    }
}

