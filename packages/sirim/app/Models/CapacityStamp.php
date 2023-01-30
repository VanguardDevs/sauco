<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Model;

class CapacityStamp extends Model
{
    protected $table = 'capacity_stamps';

    protected $fillable = [
        'capacity',
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

}
