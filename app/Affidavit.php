<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affidavit extends Model
{
    use SoftDeletes;

    protected $table = 'affidavits';

    protected $guarded = [];

    protected $casts = [
        'amount' => 'float'
    ];

    protected $with = [ 'month' ];

    protected $appends = ['total_amount', 'brute_amount_affidavit'];

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function economicActivityAffidavits()
    {
        return $this->hasMany(EconomicActivityAffidavit::class);
    }

    public function payment()
    {
        return $this->belongsToMany(Payment::class, Settlement::class);
    }

    public function settlement()
    {
        return $this->hasOne(Settlement::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Date('d/m/Y', strtotime($value)); 
    }

    public function getDeletedAtAttribute($value)
    {
        return Date('d-m-Y H:m', strtotime($value)); 
    }

    public function scopeLastAffidavit($query)
    {
        return $query->latest()->first();
    }

    public function scopePendingAffidavit($query)
    {

    }

    public function scopeFindOneByMonth($query, $taxpayer, $month)
    {
        return $query->whereTaxpayerId($taxpayer->id)
            ->whereMonthId($month->id);
    }

    public function getBruteAmountAffidavitAttribute($value)
    {
        $totalAffidavit = $this->economicActivityAffidavits->sum('brute_amount');

        return number_format($totalAffidavit, 2, ',', '.');
    }

    public function getTotalAmountAttribute($value)
    {
        return number_format($this->amount, 2, ',', '.');
    }
}
