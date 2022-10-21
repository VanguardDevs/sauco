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
        'license_id'
    ];

    public function license()
    {
        return $this->belongsTo(License::class);
    }
}
