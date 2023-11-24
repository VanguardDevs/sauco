<?php

namespace App\Services;

use App\Models\Affidavit;
use App\Models\EconomicActivityAffidavit;
use App\Models\EconomicActivity;
use App\Models\TaxUnit;
use App\Models\PetroPrice;
use Carbon\Carbon;
use App\Models\Month;
use App\Models\Year;

class AffidavitService
{
    public function update(Affidavit $affidavit, array $amounts)
    {
        $month = $affidavit->month;
        $affidavits = $affidavit->economicActivityAffidavits;
        $bruteAmounts = $amounts;
        $totalAmounts = Array();
        $economicActivities=Array();

        

        //$economicActivity= EconomicActivity::whereId($affidavits->economic_activity_id);

        foreach ($affidavits as $a) {
            $economicActivity= EconomicActivity::whereId($a->economic_activity_id);
            array_push($economicActivities, $economicActivity);
        }

        dd($economicActivities);

        $minAmount = min($amounts);
        $higherMinTax = max($economicActivity->min_tax);

        


        if($affidavits->count() > 1 && $affidavits->count() < 11){
            if($affidavits->count() == 2){

                $firstAmount = $amounts[0];
                $secondAmount = $amounts[1];

                $firstAffidavit = $affidavits[0];
                $secondAffidavit = $affidavits[1];
                
                $updateSettlement = $this->calculateTaxOnTwo($month, $firstAffidavit, $secondAffidavit, $firstAmount, $secondAmount, true);

            }
            elseif($affidavits->count() == 3){

                $firstAmount = $amounts[0];
                $secondAmount = $amounts[1];
                $thirdAmount = $amounts[2];

                $firstAffidavit = $affidavits[0];
                $secondAffidavit = $affidavits[1];
                $thirdAffidavit = $affidavits[2];
                
                $updateSettlement = $this->calculateTaxOnThree($month, $firstAffidavit, $secondAffidavit, $thirdAffidavit, $firstAmount, $secondAmount, $thirdAmount, $higherMinTax, $minAmount, true);
            }

            for($i = 0; $i < $affidavits->count(); $i++){
                array_push($totalAmounts, $updateSettlement[$i]->amount);
            }
        }
        else{      
            foreach($affidavits as $affidavit) {
                $amount = array_shift($bruteAmounts);

                if (($affidavits->count() > 2) && ($amount == 0.00)) {
                    $updateSettlement = $this->calculateTax($month, $affidavit, $amount, false);
                }
                else {
                    $updateSettlement = $this->calculateTax($month, $affidavit, $amount, true);
                }
                array_push($totalAmounts, $updateSettlement->amount);
            }
        }

        return array_sum($totalAmounts);
    }

    public function updateByGroup(Affidavit $affidavit, float $amount)
    {
        $month = $affidavit->month;
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
        return $this->calculateTax($month, $maxDeclaration, $amount, true)->amount;
    }

    public function calculateTax(Month $month, EconomicActivityAffidavit $affidavit, $amount, $update = false)
    {
        $currentYear = Carbon::now()->year;

        $total = 0.00;
        $activity = $affidavit->economicActivity;

        if ($activity->code == '123456' && $amount != 0.00) {
            $total = $amount * $activity->aliquote / 100;
        } else {
            if ($update) {

                if($activity->charging_method_id == 1) {
                    $unit = TaxUnit::latest()->first();
                }
                else{

                    if($month->year->year  == $currentYear){
                        $unit = $this->getPetroPrice($month);
                        $minTax = $unit->value * $activity->min_tax;                       
                    }
                    else{
                        $unit = $this->getOldPetroPrice($month);
                        $minTax = $unit->value * $activity->old_min_tax;
                    } 
                }
                $total = $activity->aliquote * $amount / 100;

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



    public function calculateTaxOnTwo(Month $month, EconomicActivityAffidavit $firstAffidavit, EconomicActivityAffidavit $secondAffidavit, $firstAmount, $secondAmount, $update = false)
    {
        $currentYear = Carbon::now()->year;

        $total1 = 0.00;
        $total2 = 0.00;
        $firstActivity = $firstAffidavit->economicActivity;
        $secondActivity = $secondAffidavit->economicActivity;

        if ($update) {
            $unit = $this->getPetroPrice($month);
            $minTax1 = $unit->value * $firstActivity->min_tax;
            $minTax2 = $unit->value * $secondActivity->min_tax;                       


            $total1 = $firstActivity->aliquote * $firstAmount / 100;
            $total2 = $secondActivity->aliquote * $secondAmount / 100;

            if ($minTax1==$minTax2 && $firstActivity->aliquote==$secondActivity->aliquote && $total1 < $minTax1 && $total2 < $minTax2) {
                if($firstAmount >= $secondAmount){
                    $total2 = $minTax2;
                }else{
                    $total1 = $minTax1;
                }
            }
            elseif($minTax1=!$minTax2 && ($firstActivity->aliquote==$secondActivity->aliquote || $firstActivity->aliquote=!$secondActivity->aliquote) && $total1 < $minTax1 && $total2 < $minTax2){
                if($minTax1 >= $minTax2){
                    $total1 = $minTax1;
                }else{
                    $total2 = $minTax2;
                }

            }
        }

        $firstAffidavit->update([
            'amount' => $total1,
            'brute_amount' => $firstAmount
        ]);

        $secondAffidavit->update([
            'amount' => $total2,
            'brute_amount' => $secondAmount
        ]);

        return [$firstAffidavit, $secondAffidavit];
    }


    public function calculateTaxOnThree(Month $month, EconomicActivityAffidavit $firstAffidavit, EconomicActivityAffidavit $secondAffidavit, 
    EconomicActivityAffidavit $thirdAffidavit, $firstAmount, $secondAmount, $thirdAmount, $higherMinTax, $minAmount, $update = false)
    {
        $currentYear = Carbon::now()->year;

        $total1 = 0.00;
        $total2 = 0.00;
        $total3 = 0.00;
        $firstActivity = $firstAffidavit->economicActivity;
        $secondActivity = $secondAffidavit->economicActivity;
        $thirdActivity = $thirdAffidavit->economicActivity;

        if ($update) {

            $unit = $this->getPetroPrice($month);
            $minTax1 = $unit->value * $firstActivity->min_tax;
            $minTax2 = $unit->value * $secondActivity->min_tax;
            $minTax3 = $unit->value * $thirdActivity->min_tax;                        
    
            $total1 = $firstActivity->aliquote * $firstAmount / 100;
            $total2 = $secondActivity->aliquote * $secondAmount / 100;
            $total3 = $thirdActivity->aliquote * $thirdAmount / 100;

            //if ($minTax1==$minTax2 && $minTax2==$minTax3 && $firstActivity->aliquote==$secondActivity->aliquote 
           // && $secondActivity->aliquote==$thirdActivity->aliquote && $total1 < $minTax1 && $total2 < $minTax2 && $total3 < $minTax3) {
                
                switch ($minAmount) {
                    case $firstAmount:
                        $total1 = $minTax1;
                        break;
                    case $secondAmount:
                        $total2 = $minTax2;
                        break;
                    case $thirdAmount:
                        $total3 = $minTax3;
                        break;
                }         
            /*}
            elseif(($minTax1=!$minTax2 || $minTax2=!$minTax3 || $minTax1=!$minTax3)&& ($firstActivity->aliquote==$secondActivity->aliquote && 
            $secondActivity->aliquote==$thirdActivity->aliquote)){
                switch ([$minAmount, $higherMinTax]) {
                    case[$firstAmount, $minTax1]:
                        $total1 = $minTax1;
                        break;
                    case[$secondAmount, $minTax2]:
                        $total2 = $minTax2;
                        break;
                    case[$thirdAmount, $minTax3]:
                        $total3 = $minTax3;
                        break;
                }

            }
            else{
                switch ($higherMinTax) {
                    case $minTax1:
                        $total1 = $minTax1;
                        break;
                    case $secondAmount:
                        $total2 = $minTax2;
                        break;
                    case $thirdAmount:
                        $total3 = $minTax3;
                        break;
                }

            }*/
        
        }

        $firstAffidavit->update([
            'amount' => $total1,
            'brute_amount' => $firstAmount
        ]);

        $secondAffidavit->update([
            'amount' => $total2,
            'brute_amount' => $secondAmount
        ]);

        $thirdAffidavit->update([
            'amount' => $total3,
            'brute_amount' => $thirdAmount
        ]);

        return [$firstAffidavit, $secondAffidavit, $thirdAffidavit];
    }




/*Cuando las 2 actividades poseen min_tax y alicuota iguales, y ambas califican para minimo tributable se aplica el 
MINIMO a la actividad de MENOR INGRESO y la otra actividad por ALICUOTA*/

/*Cuando el min_tax es diferente pero la Alicuota es igual para las 2 actividades, y ambas Califican para MINIMO
se aplica el MINIMO a la actividad con MAYOR min_tax y a la otra actividad se le cobra la alicuota*/

/*Cuando tanto el min_tax como la alicuota de ambas actividades es diferente y ambas califican para 
MINIMO TRIBUTABLE se aplica el MINIMO a la actividad con Mayor min_tax y a la otra actividad se le cobra la alicuota*/

/// Mas de 2 actividades ///

/*Cuando las actividades poseen min_tax y alicuota iguales, y todas califican para minimo tributable se aplica el 
MINIMO a la actividad de MENOR INGRESO y las otras actividades por ALICUOTA*/

/*Cuando el min_tax es diferente en al menos una actividad pero la Alicuota es igual para todas 
las actividades, se liquida por MINIMO la actividad con MAYOR min_tax que DECLARA MENOS
el resto se cobra por alicuota */


    protected function getPetroPrice($month)
    {
        $fromDate = Carbon::parse($month->start_period_at)->startOfMonth()->toDateString();
        $tillDate = Carbon::parse($month->start_period_at)->endOfMonth()->add(1, 'day')->toDateString();

        

        $rate = PetroPrice::whereBetween('created_at', [$fromDate,$tillDate])->latest()->first();

        if (!$rate) {
            $rate = PetroPrice::latest()->first();
        }

        return $rate;
    }


     protected function getOldPetroPrice($month)
    {

        $lastDayofMonth = Carbon::parse($month->start_period_at)->endOfMonth()->toDateString();

        $rate = PetroPrice::whereDate('created_at', $lastDayofMonth)->latest()->first();

        if (!$rate) {
            $rate = PetroPrice::latest()->first();
        }

        return $rate;
    }


}
