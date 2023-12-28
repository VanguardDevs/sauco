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

        $minAmount = min($amounts);

        $index = array_search($minAmount, $amounts);

        if($affidavits->count() > 1 && $affidavits->count() < 11){
            if($affidavits->count() == 2){

                $firstAmount = $amounts[0];
                $secondAmount = $amounts[1];

                $firstAffidavit = $affidavits[0];
                $secondAffidavit = $affidavits[1];
                
                $updateSettlement = $this->calculateTaxOnTwo($month, $firstAffidavit, $secondAffidavit, $firstAmount, $secondAmount, true);

                for($i = 0; $i < $affidavits->count(); $i++){
                    array_push($totalAmounts, $updateSettlement[$i]->amount);
                }
            }
            elseif($affidavits->count() >= 3){
                $updateSettlement = $this->calculateTaxOnMany($month, $affidavits, $amounts, $minAmount, $index, true);

                for ($i = 0; $i < $affidavits->count(); $i++) {
                    array_push($totalAmounts, $updateSettlement[$i]->amount);
                }
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

            if ($total < $minTax || $amount == 0.00 || $activity->code=='3.08.12' || $activity->code=='3.08.13') {
                $total = $minTax;
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
            elseif($firstActivity->aliquote!=$secondActivity->aliquote && $total1 < $minTax1 && $total2 < $minTax2){
                if($minTax1 > $minTax2){
                    $total1 = $minTax1;
                }else{
                    $total2 = $minTax2;
                }
            }
            elseif($firstActivity->code=='3.08.12' || $firstActivity->code=='3.08.13'|| $secondActivity->code=='3.08.12' || $secondActivity->code=='3.08.13'){
                if($firstActivity->code=='3.08.12'|| $firstActivity->code=='3.08.13'){
                    $total1 = $minTax1;
                }elseif($secondActivity->code=='3.08.12'|| $secondActivity->code=='3.08.13'){
                    $total2 = $minTax2;
                }
            }
            else{
                if($firstAmount >= $secondAmount && $total2 < $minTax2){
                    $total2 = $minTax2;
                }elseif($secondAmount >= $firstAmount && $total1 < $minTax1){
                    $total1 = $minTax1;
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


    public function calculateTaxOnMany(Month $month, $affidavits, $amounts, $minAmount, $index, $update = false)
    {
        $unit = $this->getPetroPrice($month);
        $count= $affidavits->count();

        for ($i = 0; $i < $count; $i++) {
            $minTax = $unit->value * $affidavits[$i]->economicActivity->min_tax;
            $total = $affidavits[$i]->economicActivity->aliquote * $amounts[$i] / 100;

            if(($i==$index && $total < $minTax) || ($affidavits[$i]->economicActivity->code=='3.08.12' || $affidavits[$i]->economicActivity->code=='3.08.13')){
                $total = $minTax;
            }
   
            $affidavits[$i]->update([
                'amount' => $total,
                'brute_amount' => $amounts[$i]
            ]);
            
        }

        return $affidavits;
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
