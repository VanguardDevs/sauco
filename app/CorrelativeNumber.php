<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorrelativeNumber extends Model
{
    protected $table = 'correlative_numbers';

    protected $guarded = [];

    public function license()
    {
        return $this->hasOneThrough(License::class, Correlative::class);
    }

    public function correlative()
    {
        return $this->hasMany(Correlative::class);
    }

    public static function getNum()
    {
        if (self::lastCorrelative()->count()) {
            $lastNum = self::lastCorrelative()->num;
            $newNum = ltrim($lastNum, "0") + 1; // Lastnum + 1
            $payNum = str_pad($newNum,5,"0",STR_PAD_LEFT);
        } else {
            $payNum = "00001";
        }
        return $payNum;
    }

    public function scopeLastCorrelative($query)
    {
        return $query->latest()->first();
    }
}
