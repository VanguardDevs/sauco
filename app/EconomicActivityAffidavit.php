<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EconomicActivityAffidavit extends Model
{
    use SoftDeletes;

    protected $table = 'economic_activity_affidavit';

    protected $guarded = [];

    protected $casts = [
        'amount' => 'float'
    ];

    public function economicActivity()
    {
        return $this->belongsTo(EconomicActivity::class);
    }

    public function settlement()
    {
        return $this->belongsTo(Settlement::class);
    }

    public function getBruteAmountFormatAttribute()
    {
        return number_format($this->brute_amount, 2, ',', '.');
    }

    public function getAmountFormatAttribute()
    {
        return number_format($this->amount, 2, ',', '.');
    }
}
