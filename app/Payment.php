<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;

class Payment extends Model implements Auditable
{
    use Audit;
    use SoftDeletes;

    protected $table = 'payments';

    protected $fillable = [
        'num',
        'amount',
        'total_amount',
        'payment_state_id',
        'payment_type_id',
        'user_id'
    ];

    public function paymentState()
    {
        return $this->belongsTo(PaymentState::class);
    }

    public function user()
    {
        return $this->belongsTo(Payment::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function references()
    {
        return $this->hasMany(Reference::class);
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class, Settlement::class);
    }

    public function scopeLastPayment($query)
    {
        return $query->latest()->first();
    }
}
