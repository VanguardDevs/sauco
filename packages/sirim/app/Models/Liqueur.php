<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liqueur extends Model
{

    protected $table = 'liqueurs';

    protected $fillable = [
        'work_hours',
        'is_mobile',
        'liqueur_parameter_id',
        'representation_id',
        'license_id',
        'num'
    ];


    protected $appends = [
        'license'
    ];

    public static function getNum()
    {
        if (self::get()->count()) {
            $lastNum = self::get()->last()->num;
            $newNum = ltrim($lastNum, "0") + 1; // Lastnum + 1
            $payNum = str_pad($newNum,5,"0",STR_PAD_LEFT);
        } else {
            $payNum = "00001";
        }
        return $payNum;
    }

    public function liqueur_parameter()
    {
        return $this->belongsTo(LiqueurParameter::class);
    }

    public function representation()
    {
        return $this->belongsTo(Representation::class);
    }

    public function license()
    {
        return $this->belongsTo(License::class);
    }


    public function liquidations()
    {
        return $this->belongsToMany(Liquidation::class, 'liqueur_liquidation');
    }

    /*public function liqueur_vehicle()
    {
        return $this->hasMany(LiqueurVehicle::class, 'liqueur_id');
    }*/

    /*public function leased_liqueur()
    {
        return $this->hasMany(LeasedLiqueur::class, 'liqueur_id');
    }*/

    public function liqueur_annex()
    {
        return $this->hasMany(LiqueurAnnex::class, 'liqueur_id');
    }

    public function getLicenseAttribute()
    {
        $this->load('license');
    }
}
