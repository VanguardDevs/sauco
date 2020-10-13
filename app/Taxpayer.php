<?php

namespace App;

use App\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Taxpayer extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'taxpayers';

    protected $fillable = [
        'rif',
        'name',
        'address',
        'fiscal_address',
        'phone',
        'email',
        'community_id',
        'taxpayer_type_id',
        'taxpayer_classification_id',
    ];

    public function hasException()
    {
        $query = $this->economicActivities()
            ->whereCode(123456);

        return $query->first() ? true : false;
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function getRifAttribute($value)
    {
        return $this->taxpayerType->correlative.$value;
    }

    public static function existsRif($rif)
    {
        return self::whereRif($rif)->first();
    } 

    public function president()
    {
        return $this->representations->filter(function ($item, $key) {
            if ($item->representationType->name == 'PRESIDENTE') {
                return $item;
            } 
        });
    }

    public function liquidations()
    {
        return $this->hasMany(Liquidation::class);
    }

    public function representations()
    {
        return $this->hasMany(Representation::class);
    }

    public function commercialRegister()
    {
        return $this->hasOne(CommercialRegister::class);
    }

    public function taxpayerType()
    {
        return $this->belongsTo(TaxpayerType::class);
    }

    public function economicActivities()
    {
        return $this->belongsToMany(EconomicActivity::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }

    public function commercialDenomination()
    {
        return $this->hasOne(CommercialDenomination::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    
    public function fines()
    {
        return $this->hasMany(Fine::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function withholdings()
    {
        return $this->hasManyThrough(Withholding::class, Affidavit::class);
    } 

    public function affidavits()
    {
        return $this->hasMany(Affidavit::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function requirement()
    {
        return $this->belongsToMany(Requirement::class);
    }

    public function taxpayerClassification()
    {
        return $this->belongsTo(TaxpayerClassification::class);
    }
}
