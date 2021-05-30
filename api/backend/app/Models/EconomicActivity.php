<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EconomicActivity extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'economic_activities';

    protected $fillable = [
        'code',
        'name',
        'description',
        'aliquote',
        'min_tax',
    ];

    protected $casts = [
        'aliquote' => 'float',
        'min_tax' => 'integer'
    ];

    public function licenses()
    {
        return $this->belongsToMany(License::class);
    }

    public function taxpayers()
    {
        return $this->belongsToMany(Taxpayer::class);
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
