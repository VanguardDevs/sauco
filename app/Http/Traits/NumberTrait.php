<?php

namespace App\Http\Traits;

use App\Payment;
use App\Settlement;
use App\Application;
use App\Fine;

trait NumberTrait
{
    public function getNewNum(Ordinance $ordinance)
    {
        $name = $ordinance->name;

        if ($name = 'ACTIVIDAD ECONÓMICA') {
            return $this->getSettlementNum();
        }
    }

    protected function getSettlementNum()
    {
        return Settlement::lastSettlement();
    }
}
