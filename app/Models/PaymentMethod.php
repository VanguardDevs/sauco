<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';

    protected $fillable = [
        'name'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    
    public function scopeExceptNull($query)
    {
        return $query->where('name', '!=', 'S/N')->pluck('name', 'id');
    }
}
