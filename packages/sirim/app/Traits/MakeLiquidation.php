<?php

namespace App\Traits;

use App\Models\Liquidation;
use App\Models\Concept;

trait MakeLiquidation
{
    public function makeLiquidation()
    {
        if (get_class($this) == 'App\Models\Affidavit') {
            $concept = Concept::whereCode(1)->first();
        } else if (get_class($this) == 'App\Models\Withholding') {
            $concept = Concept::whereCode('301.03.99.100')->first();
        } else {
            $concept = $this->concept;
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
        if ($concept->code == '301.03.99.100') {
            return $concept->name;
        }

        return $this->concept->name;
    }
}
