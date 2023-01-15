<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VehicleCorrelative extends Model
{
    protected $table = 'vehicle_correlatives';

    protected $fillable = [
        'num',
        'license_id',
        'year_id'
    ];


    public function getNumberAttribute()
    {
        return 'MBES'.$this->year->year.'IV-'.$this->num;
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }


    public function license()
    {
        return $this->belongsTo(License::class);
    }


    public static function getNewNum()
    {
        if (self::lastVehicleCorrelative()->count()) {
            $lastNum = self::lastVehicleCorrelative()->num;
            $newNum = ltrim($lastNum, "0") + 1; // Lastnum + 1
            $payNum = str_pad($newNum,5,"0",STR_PAD_LEFT);
            
        } else {
            $payNum = "00001";
        }
        return $payNum;
    }


    public function scopeLastVehicleCorrelative($query)
    {
        return $query->latest()->first();
    }
}
