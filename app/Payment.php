<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'num',
        'total_amount',
        'amount',
        'payment_type_id',
        'payment_state_id',
        'license_id',
        'user_id'
    ];

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function paymentState()
    {
        return $this->belongsTo(PaymentState::class);
    }

    public function user()
    {
        return $this->belongsTo(Payment::class);
    }

    public function license()
    {
        return $this->belongsTo(License::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }
}
