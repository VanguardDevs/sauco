<?php

namespace App\Traits;

use App\Liquidation;
use App\Concept;

trait MakeLiquidation
{
    public function makeLiquidation()
    {
        if (method_exists($this, 'concept')) {
            $concept = $this->concept;
        } else {
            $concept = Concept::whereCode(1)->first();
        }

        $objectPayment = $this->getObject($concept);

        $liquidation = $this->liquidation()->create([
            'num' => Liquidation::getNewNum(),
            'object_payment' =>  $objectPayment,
            'amount' => $this->amount
            'user_id' => $this->user_id,
            'status_id' => 1,
            'concept_id' => $concept->id,
            'taxpayer_id' => $this->taxpayer_id
        ]);
    } 

    private function getObject($concept)
    {
        if ($concept->code == 1) {
            return $concept->name.': '
                .$this->month->name
                .' - '.$this->month->year->year;
        }
        return $this->concept->name;
    }
}
