<?php

namespace App\Traits;

trait PrettyAmount
{   
    public function getPrettyAmountAttribute()
    {
        return number_format($this->amount, 2, ',', '.');
    }
}
