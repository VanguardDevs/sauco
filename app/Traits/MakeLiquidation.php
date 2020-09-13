<?php

namespace App\Traits;

use App\Liquidation;
use App\Concept;

trait MakeLiquidation
{
    public $concept;

    public function __construct()
    {
        if (method_exists($this, 'concept')) {
            $this->concept = $this->concept;
        } else {
            $this->concept = Concept::whereCode(1)->first();
        }
    }

    public function makeLiquidation()
    {
        $concept = $this->concept;
        $objectPayment = $this->getObject($concept);

        $liquidation = $this->liquidation()->create([
            'num' => Liquidation::getNewNum(),
            'user_id' => $this->user_id,
            'object_payment' =>  $objectPayment,
            'status_id' => 1,
            'concept_id' => $concept->id,
            'liquidation_type_id' => $concept->liquidation_type_id,
            'taxpayer_id' => $this->taxpayer_id,
            'amount' => $this->amount
        ]);
    } 

    private function getObject($concept)
    {
        if ($concept->code == 1) {
            return $this->concept->name.': '
                .$this->month->name
                .' - '.$this->month->year->year;
        }
        return $concept->name;
    }
}
