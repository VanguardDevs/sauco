<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
    protected $table = 'parishes';

    protected $fillable = ['name'];

    public function communities()
    {
        return $this->belongsToMany(Community::class);
    }
}
