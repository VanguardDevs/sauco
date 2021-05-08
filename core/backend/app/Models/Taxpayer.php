<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Taxpayer extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes, HasFactory;

    protected $table = 'taxpayers';

    protected $fillable = [
        'rif',
        'name',
        'address',
        'phone',
        'email',
        'community_id',
        'municipality_id',
        'taxpayer_type_id',
        'taxpayer_classification_id',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
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

    public function licenses()
    {
        return $this->hasMany(License::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
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

    public function deductions()
    {
        return $this->hasManyThrough(Deduction::class, Affidavit::class);
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

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function movements()
    {
    	return $this->hasMany(Movement::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'taxpayer_property');
    }
}
