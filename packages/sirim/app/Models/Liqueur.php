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
        'is_mobile',
        'liqueur_parameter_id',
        'representation_id',
        'liqueur_classification_id',
        'license_id',
        'registry_date'
    ];

    public static function getNum()
    {
        $lastNum = self::get()->last()->num;
        $lastNum = explode('-', $lastNum)[1];
        $newNum = ltrim($lastNum, "0") + 1; // Lastnum + 1
        $numFormmated = str_pad($newNum,5,"0",STR_PAD_LEFT);

        return $numFormmated;
    }

    public function license()
    {
        return $this->belongsTo(License::class);
    }

    public function liqueurParameter()
    {
        return $this->belongsTo(LiqueurParameter::class);
    }

    public function liqueurClassification()
    {
        return $this->belongsTo(LiqueurClassification::class);
    }

    public function representation()
    {
        return $this->belongsTo(Representation::class);
    }

    public function liquidations()
    {
        return $this->belongsToMany(Liquidation::class, 'liqueur_liquidation');
    }

    public function leasedLiqueur()
    {
        return $this->hasMany(LeasedLiqueur::class, 'liqueur_id');
    }

    public function annexes()
    {
        return $this->belongsToMany(AnnexedLiqueur::class, 'liqueur_annexes', 'liqueur_id', 'annex_id');
    }
}
