<?php

namespace App\Traits;

use App\Models\Liquidation;
use App\Models\Concept;

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
            'amount' => $this->amount,
            'liquidable_type' => get_class($this),
            'concept_id' => $concept->id,
            'liquidation_type_id' => $concept->liquidation_type_id,
            'status_id' => 1,
            'taxpayer_id' => $this->taxpayer_id
        ]);

        return $liquidation;
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
