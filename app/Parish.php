<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parish extends Model
{
    use HasFactory;

    protected $table = 'parishes';

    protected $fillable = ['name'];

    public function communities()
    {
        return $this->belongsToMany(Community::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
