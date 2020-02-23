<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EconomicActivitySettlement extends Model
{
    protected $table = 'economic_activity_settlement';

    protected $guarded = [];

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function economicActivity()
    {
        return $this->belongsTo(EconomicActivity::class);
    }

    public function settlement()
    {
        return $this->belongsTo(Settlement::class);
    }
}
