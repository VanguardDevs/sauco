<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Concept extends Model
{
    use SoftDeletes;

    protected $table = 'concepts';

    protected $fillable = [
        'value',
        'description',
        'charging_method_id',
        'ordinance_id'
    ];

    public function chargingMethod()
    {
        return $this->belongsTo(ChargingMethod::class);
    }

    public function ordinance()
    {
        return $this->belongsTo(Ordinance::class);
    }

    public function requisites()
    {
        return $this->hasMany(Requisite::class);
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

    public function setPublicationDateAttribute($value)
    {
        $this->attributes['publication_date'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }

    public function getPublicationDateAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
