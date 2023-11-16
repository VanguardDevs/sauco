<?php

namespace App\Services;

use App\Models\Affidavit;
use App\Models\EconomicActivityAffidavit;
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

        /*$firstAffidavit=$affidavits[0]->economicActivity;
        $secondAffidavit=$affidavits[1];*/

        $firstAffidavit = $affidavits->first();
        $secondAffidavit = $affidavits->get(1);

        /*
        $secondAffidavit = $affidavits->skip(1)->first();
        $secondAffidavit = $affidavits->skip(1)->take(1)->first();
         */

        
        foreach($affidavits as $affidavit) {
            $amount = array_shift($bruteAmounts);

            if (($affidavits->count() > 2) && ($amount == 0.00)) {
                $updateSettlement = $this->calculateTax($month, $affidavit, $amount, false, $affidavits);
            }
           /* elseif($affidavits->count() == 2){
            
                if ($firstAffidavit->economicActivity->min_tax > $secondAffidavit->economicActivity->min_tax) {
                    //$maxDeclaration = $affidavit;
                    $updateSettlement = $this->calculateTax($month, $affidavit, $amount, true, $affidavits);
                }
            }*/
            else {
                $updateSettlement = $this->calculateTax($month, $affidavit, $amount, true, $affidavits);
            }

            array_push($totalAmounts, $updateSettlement->amount);
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

        return $this->calculateTax($month, $maxDeclaration, $amount, true, $affidavits)->amount;
    }

    public function calculateTax(Month $month, EconomicActivityAffidavit $affidavit, $amount, $update = false, $arrayAffidavits)
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

                    /////////////////////
                if($arrayAffidavits->count() == 2){
                    $firstAffidavit = $affidavits->first();
                    $secondAffidavit = $affidavits->get(1);

                    if($firstAffidavit->economicActivity->min_tax = $secondAffidavit->economicActivity->min_tax){

                    }

                }
////////////////////////////////////////////////////////

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
                las actividades, se liquida por MINIMO la actividad con MAYOR min_tax y la actividad que DECLARA MENOS
                el resto se cobra por alicuota */

            }
        }

        $affidavit->update([
            'amount' => $total,
            'brute_amount' => $amount
        ]);

        return $affidavit;
    }

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
