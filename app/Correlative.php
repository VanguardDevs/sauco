<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correlative extends Model
{
    protected $table = 'correlatives';

    protected $fillable = [
        'num'
    ];

    public function correlativeStates()
    {
        return $this->hasMany(CorrelativeState::class);
    }

    public static function getNum()
    {
        if (self::lastCorrelative()->count()) {
            $lastNum = self::lastCorrelative()->num;
            $newNum = ltrim($lastNum, 0) + 1;
            $newNum = str_pad($newNum, 5, "0", STR_PAD_LEFT);
        } else {
            $newNum = "00001";
        }

        return $newNum;
    }

    public function scopeLastCorrelative($query)
    {
        return $query->withTrashed()->latest()->first();
    }
}
