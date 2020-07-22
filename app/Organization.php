<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'organizations';

    protected $fillable = [
        'rif', 'name', 'address'
    ];

    public function payment()
    {
        return $this->belongsToMany(Payment::class);
    }
}
