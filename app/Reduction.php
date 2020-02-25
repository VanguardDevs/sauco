<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reduction extends Model
{
    protected $table = 'reductions';

    protected $fillable = [
        'code',
        'name',
        'percentage'
    ];

    public function settlements()
    {
        return $this->belongsToMany(Settlement::class);
    }
}
