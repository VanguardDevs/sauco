<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;

    protected $table = 'applications';

    protected $guarded = [];

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function payment()
    {
        return $this->belongsToMany(Payment::class, Settlement::class);
    }

    public function settlement()
    {
        return $this->hasOne(Settlement::class);
    }

    public function getAmountAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function getCreatedAtAttribute($value)
    {
        return Date('d/m/Y H:m', strtotime($value));
    }
}
