<?php

namespace App\Traits;
use DateTime;

trait ReportUtils
{
    public static function getDatesFormatted($elems, $dateAttribute)
    {
        $firstDate = $elems->first()[$dateAttribute];
        $lastDate = $elems->last()[$dateAttribute];

        $firstDateFormatted = DateTime::createFromFormat("d/m/Y h:i", $firstDate)->format("d-m-Y");
        $lastDateFormatted = DateTime::createFromFormat("d/m/Y h:i", $lastDate)->format("d-m-Y");
        $dateFormat = $firstDateFormatted.' - '.$lastDateFormatted;

        return $dateFormat;
    }

    public static function getTotalFormattedAmount($query, $amount)
    {
        $amount = $query->sum('amount');
        $total = number_format($amount, 2, ',', '.')." Bs";

        return $total;
    }
}
