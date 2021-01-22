<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $table = 'payment_types';

    protected $fillable = [
        'description'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeExceptNull($query)
    {
        return $query->where('description', '!=', 'S/N')->pluck('description', 'id');
    }
}
