<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settlement extends Model
{
    use SoftDeletes;

    protected $table = 'settlements';

    protected $fillable = [
        'num',
        'amount',
        'concept_id',
        'state_id',
        'taxpayer_id',
        'month_id'
    ];

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function state()
    {
        return $this->belongsTo(Status::class);
    }

    public function reductions()
    {
        return $this->belongsToMany(Reduction::class);
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Date('d/m/Y', strtotime($value)); 
    }

    public function scopeLastSettlement($query)
    {
        return $query->withTrashed()->latest()->first();
    }
}
