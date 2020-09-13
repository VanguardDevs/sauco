<?php

namespace App\Traits;

trait FormattedAmount
{   
    public function getPrettyAmountAttribute()
    {
        return number_format($this->amount, 2, ',', '.');
    }
}
