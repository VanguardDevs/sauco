<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EconomicActivitySettlement extends Model
{
    use SoftDeletes;

    protected $table = 'economic_activity_settlement';

    protected $guarded = [];

    public function economicActivity()
    {
        return $this->belongsTo(EconomicActivity::class);
    }

    public function settlement()
    {
        return $this->belongsTo(Settlement::class);
    }
}
