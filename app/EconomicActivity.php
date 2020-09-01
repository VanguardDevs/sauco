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

    public function taxpayers()
    {
        return $this->belongsToMany(Taxpayer::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    } 

    public function affidavits()
    {
        return $this->belongsToMany(Affidavit::class);
    }

    public function activityClassification()
    {
        return $this->belongsTo(ActivityClassification::class);
    }
    
    public function getFullNameAttribute()
    {
        return "{$this->code} - {$this->attributes['name']}";
    }
}
