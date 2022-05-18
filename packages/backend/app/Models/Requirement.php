<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $table = 'requirements';

    protected $fillable = [
        'num',
        'name',
        'period_id'
    ];

    public function interval()
    {
        return $this->belongsTo(Interval::class, 'period_id');
    }

    public function concept()
    {
        return $this->hasMany(Concept::class);
    }

    public function taxpayer()
    {
        return $this->hasMany(Taxpayer::class);
    }
}
