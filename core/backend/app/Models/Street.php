<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    protected $table = 'streets';

    protected $fillable = [
        'code',
        'name'
    ];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function communities()
    {
        return $this->belongsToMany(Community::class);
    }
}
