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
        return $this->belongsToMany(Payment::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Date('d/m/Y', strtotime($value)); 
    }

    public function getDeletedAtAttribute($value)
    {
        return Date('d-m-Y H:m', strtotime($value)); 
    }

    public function scopeLastSettlement($query)
    {
        return $query->withTrashed()->latest()->first();
    }

    public function getBruteAmountAffidavitAttribute($value)
    {
        $totalAffidavit = $this->affidavits->sum('brute_amount');

        return number_format($totalAffidavit, 2, ',', '.');
    }

    public function getTotalAmountAttribute($value)
    {
        return number_format($this->amount, 2, ',', '.');
    }
}
