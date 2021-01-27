<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{
    protected $table = 'purposes';

    protected $fillable = [
        'name',
        'value'
    ];

    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }
}
