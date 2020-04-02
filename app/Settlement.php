<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settlement extends Model
{
    use SoftDeletes;

    protected $table = 'settlements';

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

    public function state()
    {
        return $this->belongsTo(Status::class);
    }

    public function reductions()
    {
        return $this->belongsToMany(Reduction::class);
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function affidavits()
    {
        return $this->hasMany(Affidavit::class);
    }

    public function receivable()
    {
        return $this->hasMany(Receivable::class);
    }

    public static function newNum()
    {
        $lastNum = Settlement::withTrashed()
            ->whereStateId(2)
            ->orderBy('num','DESC')
            ->first()
            ->num;

        $newNum = str_pad($lastNum + 1, 8, '0', STR_PAD_LEFT);
        return $newNum;
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
    
    public function payment()
    {
        return $this->belongsToMany(Payment::class, Receivable::class)
            ->first();
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
