<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EconomicActivity extends Model
{
    use SoftDeletes;

    protected $table = 'economic_activities';

    protected $fillable = [
        'code',
        'name',
        'aliquote',
        'min_tax',
        'activity_classification_id'
    ];

    protected $appends = ['fullName'];

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function economicActivitySettlements()
    {
        return $this->hasMany(EconomicActivitySettlement::class);
    }

    public function activityClassification()
    {
        return $this->belongsTo(ActivityClassification::class);
    }
    
    public function getFullNameAttribute()
    {
        return "{$this->code} - {$this->attributes['name']}";
    }

    /**
     * Return all taxpayers with community
     */
    public function getTaxpayers()
    {
        return $this->taxpayers->load('community');
    }
}
