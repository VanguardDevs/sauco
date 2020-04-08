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
        'municipality_id'
    ];

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

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

    public function receivables()
    {
        return $this->hasMany(Receivable::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getFiscalAddressAttribute()
    {
        return $this->attributes['fiscal_address'].
            ', '.$this->community->name;
    }
    
    /**
     * Affidavit incomes
     */
    public function declarations()
    {
        return $this->settlements()
            ->with(['state', 'month', 'month.year'])
            ->where('concept_id', 1);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
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
}
