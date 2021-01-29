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
        'amount' => 'float',
        'brute_amount' => 'float' 
    ];

    protected $appends = [
        'affidavit_amount',
        'calc'
    ];

    public function economicActivity()
    {
        return $this->belongsTo(EconomicActivity::class);
    }

    public function affidavit()
    {
        return $this->belongsTo(Affidavit::class);
    }

    public function getAffidavitAmountAttribute($value)
    {
        return number_format($this->brute_amount, 2, ',', '.');
    }

    public function getCalcAttribute($value)
    {
        return number_format($this->amount, 2, ',', '.');
    }
}
