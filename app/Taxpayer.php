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
        'permanent_status',
        'capital',
        'compliance_use',
        'locality',
        'fiscal_address',
        'phone',
        'email',
        'taxpayer_type_id',
        'economic_sector_id',
        'community_id',
        'municipality_id'
    ];

    public function representations()
    {
        return $this->hasMany(Representation::class);
    }

    public function economicSector()
    {
        return $this->belongsTo(EconomicSector::class);
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
        return $this->hasManyThrough(Receivable::class, Settlement::class);
    }
    
    public function payments()
    {
        return Payment
            ::join('receivables', 'payments.id', '=', 'receivables.payment_id')
            ->join('settlements', 'receivables.settlement_id', '=', 'settlements.id')
            ->join('taxpayers', 'settlements.taxpayer_id', '=', 'taxpayers.id')
            ->where('taxpayers.id',  $this->id);       
    }
    
    /**
     * Affidavit incomes
     */
    public function declarations()
    {
        return $this->settlements()
            ->with(['state', 'month'])
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
