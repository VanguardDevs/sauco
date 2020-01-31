<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'num',
        'total_amount',
        'description',
        'amount',
        'payment_state_id',
        'taxpayer_id',
        'user_id',
        'month_id',
        'concept_id'
    ];

    public function paymentState()
    {
        return $this->belongsTo(PaymentState::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function user()
    {
        return $this->belongsTo(Payment::class);
    }

    public function references()
    {
        return $this->hasMany(Reference::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }
}
