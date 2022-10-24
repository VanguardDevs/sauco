<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevenueStamp extends Model
{
    protected $table = 'revenue_stamps';

    protected $fillable = [
        'date',
        'payment_num',
        'amount',
        'observations',
        'license_id',
        'user_id'
    ];

    public function license()
    {
        return $this->belongsTo(License::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function taxpayer()
    {
        return $this->hasOneThrough(License::class, Taxpayer::class);
    }

    public function getDateAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
}
