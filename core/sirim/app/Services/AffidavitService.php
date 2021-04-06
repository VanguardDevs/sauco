<?php

namespace App\Services;

use App\Models\Affidavit;
use App\Models\EconomicActivityAffidavit;
use App\Models\TaxUnit;

class AffidavitService
{
    public function update(Affidavit $affidavit, array $amounts)
    {
        $affidavits = $affidavit->economicActivityAffidavits;
        $bruteAmounts = $amounts;
        $totalAmounts = Array();

        foreach($affidavits as $affidavit) {
            $amount = array_shift($bruteAmounts);

            if (($affidavits->count() > 2) && ($amount == 0.00)) {
                $updateSettlement = $this->calculateTax($affidavit, $amount);
            } else {
                $updateSettlement = $this->calculateTax($affidavit, $amount, true);
            }

            array_push($totalAmounts, $updateSettlement->amount);
        }

        return array_sum($totalAmounts);
    }

    public function updateByGroup(Affidavit $affidavit, float $amount)
    {
        $affidavits = $affidavit->economicActivityAffidavits;
        $maxDeclaration = $affidavits->first();

        if ($amount == 0.00) {
            foreach ($affidavits as $affidavit) {
                if ($affidavit->economicActivity->min_tax > $maxDeclaration->economicActivity->min_tax) {
                    $maxDeclaration = $affidavit;
                }
            }
        } else {
            foreach ($affidavits as $affidavit) {
                if ($affidavit->economicActivity->aliquote > $maxDeclaration->economicActivity->aliquote) {
                    $maxDeclaration = $affidavit;
                }
            }
        }

        return $this->calculateTax($maxDeclaration, $amount, true)->amount;
    }

    public function calculateTax(EconomicActivityAffidavit $affidavit, $amount, $update = false)
    {
        $total = 0.00;
        $activity = $affidavit->economicActivity;

        if ($activity->code == '123456') {
            $total = $amount * $activity->aliquote / 100;
        } else {
            if ($update) {
                $taxUnit = TaxUnit::latest()->first();
                $total = $activity->aliquote * $amount / 100;
                $minTax = $taxUnit->value * $activity->min_tax;

                if ($total < $minTax || $amount == 0.00) {
                    $total = $minTax;
                }
            }
        }

        $affidavit->update([
            'amount' => $total,
            'brute_amount' => $amount
        ]);
        return $affidavit;
    }
}
