<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liqueur extends Model
{
    protected $table = 'liqueurs';

    protected $fillable = [
        'work_hours',
        'num',
        'address',
        'is_mobile',
        'liqueur_parameter_id',
        'representation_id',
        'liqueur_classification_id',
        'license_id',
        'registry_date'
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

    public function liqueurParameter()
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

    public function leasedLiqueur()
    {
        return $this->hasMany(LeasedLiqueur::class, 'liqueur_id');
    }

    public function annexes()
    {
        return $this->belongsToMany(AnnexedLiqueur::class, 'liqueur_annexes', 'liqueur_id', 'annex_id');
    }
}
