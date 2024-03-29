<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\EconomicActivity;

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
        'dismissal_num',
    ];

    public static function replaceActivities($oldCode, $newCode)
    {
        $taxpayers = self::whereHas('economicActivities', function ($q) use ($oldCode) {
            $q->where('code', $oldCode);
        })->get();

        $oldAct = EconomicActivity::where('code', '=', $oldCode)->first();
        $newAct = EconomicActivity::where('code', '=', $newCode)->first();

        foreach($taxpayers as $taxpayer) {
            $taxpayer->economicActivities()->detach($oldAct);
            $taxpayer->economicActivities()->attach($newAct);
        }

        return true;
    }

    public function deductions()
    {
        return $this->hasManyThrough(Deduction::class, Liquidation::class);
    }

    public function representations()
    {
        return $this->hasMany(Representation::class);
    }

    public function liquidations()
    {
        return $this->hasMany(Liquidation::class);
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

    public function credits()
    {
        return $this->hasMany(Credit::class);
    }

    public function withholdings()
    {
        return $this->hasManyThrough(Withholding::class, Affidavit::class);
    }

    public function affidavits()
    {
        return $this->hasMany(Affidavit::class);
    }

    public function requirements()
    {
        return $this->belongsToMany(Requirement::class, 'requirement_taxpayer');
    }

    public function requirementTaxpayer()
    {
        return $this->hasMany(RequirementTaxpayer::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function taxpayerClassification()
    {
        return $this->belongsTo(TaxpayerClassification::class);
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
