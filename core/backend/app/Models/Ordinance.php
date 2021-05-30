<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordinance extends Model
{
    protected $table = 'ordinances';

    protected $fillable = [
        'description'
    ];

    public function concepts()
    {
        return $this->hasMany(Concept::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }
}
