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
        'payment_id',
        'concept_id',
        'taxpayer_id',
        'month_id'
    ];

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function scopeLastSettlement($query)
    {
        return $query->latest()->first();
    }
}
