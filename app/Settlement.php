<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settlement extends Model
{
    use SoftDeletes;

    protected $table = 'settlements';

    protected $guarded = [];

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function state()
    {
        return $this->belongsTo(Status::class);
    }

    public function reduction()
    {
        return $this->belongsTo(Reduction::class);
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function scopeLastSettlement($query)
    {
        return $query->withTrashed()->latest()->first();
    }
}
