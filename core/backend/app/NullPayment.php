<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NullPayment extends Model
{
    protected $table = 'null_payments';

    protected $fillable = [
        'reason',
        'user_id',
        'payment_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class)->withTrashed();
    }

    public function taxpayer()
    {
        return $this->payment->taxpayer();
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:i', strtotime($value));
    }
}
