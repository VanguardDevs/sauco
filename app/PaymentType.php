<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $table = 'payment_types';

    protected $fillable = Array(
        'description'
    );

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
