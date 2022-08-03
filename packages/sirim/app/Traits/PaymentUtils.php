<?php

namespace App\Traits;

use App\Models\Payment;
use Carbon\Carbon;

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

    public function createMovements()
    {
        $liquidations = $this->liquidations;

        $currYear = Carbon::today()->year;
        foreach($liquidations as $liq) {
            $concurrent = ($liq->year()->year == $currYear) ? true : false;

            $this->movements()->create([
                'amount' => $liq->amount,
                'concurrent' => $concurrent,
                'concept_id' => $liq->concept_id,
                'liquidation_id' => $liq->id,
                'year_id' => $liq->year()->id
            ]);
        }
    }

    /**
     * Check for each liquidation type, status or whatever it needs
     * And apply custom methods
     */
    public function checkLiquidations()
    {
        $liquidations = $this->liquidations;

        foreach($liquidations as $liq) {
            if ($liq->liquidable_type == 'App\Models\License') {
                $liq->updateLicenseStatus();
            } else {
                $liq->checkRequirements();
            }
        }
    }
}
