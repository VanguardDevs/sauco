<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentState extends Model
{
    protected $table = 'payment_states';

    protected $fillable = [
        'description'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
