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
        'min_tax'
    ];

    public function taxpayers()
    {
        return $this->belongsToMany(EconomicActivity::class);
    }

    public function economicActivitySettlements()
    {
        return $this->hasMany(EconomicActivitySettlement::class);
    }
}
