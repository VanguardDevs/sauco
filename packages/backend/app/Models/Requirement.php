<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $table = 'requirements';

    protected $fillable = [
        'code',
        'name'
    ];

    public function concept()
    {
        return $this->belongsToMany(Concept::class);
    }

    public function taxpayer()
    {
        return $this->belongsToMany(Taxpayer::class);
    }
}
