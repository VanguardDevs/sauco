<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapacityStamp extends Model
{
    protected $table = 'capacity_stamps';

    protected $fillable = [
        'capacity',
        'license_id',
        'user_id',
        'created_at'
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

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

}
