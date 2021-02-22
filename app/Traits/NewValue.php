<?php

namespace App\Traits;

trait NewValue
{
    public static function getNewNum()
    {
        $lastNum = self::withTrashed()
            ->whereStatusId(2)
            ->orderBy('num', 'DESC')
            ->first()
            ->num;

        $newNum = str_pad($lastNum + 1, 8, '0', STR_PAD_LEFT);
        return $newNum;
    } 

    public static function getNewCode()
    {
        $lastCode = self::withTrashed()
            ->orderBy('code', 'DESC')
            ->first()
            ->code;

        $newCode = $lastCode + 1;
        return $newCode;    
    }
}
