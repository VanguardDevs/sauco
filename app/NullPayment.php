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
        return $this->hasOne(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
