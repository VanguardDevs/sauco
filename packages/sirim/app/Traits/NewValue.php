<?php

namespace App\Traits;

trait NewValue
{
    public static function getNewNum($status = null)
    {
        $query = self::withTrashed();

        if ($status != null) {
            $query->whereStatusId($status);
        }

        $lastNum = '00000000';

        if ($query->count()) {
            $lastNum = $query->orderBy('num', 'DESC')->first()->num;
        }

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
