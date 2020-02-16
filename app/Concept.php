<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\TaxUnit;

class Concept extends Model
{
    use SoftDeletes;

    protected $table = 'concepts';

    protected $fillable = [
        'name',
        'observations',
        'ordinance_id',
        'list_id'
    ];

    public function ordinance()
    {
        return $this->belongsTo(Ordinance::class);
    }

    public function requisites()
    {
        return $this->hasMany(Requisite::class);
    }

    public function conceptPrices()
    {
        return $this->hasMany(ConcepPrice::class);
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function scopeGetAmount($query, Taxpayer $taxpayer, Concept $concept)
    {
        if ($concept->chargingMethod->name == 'U.T') {
            // Get amount according to taxpayer and concept
            $currentUT = TaxUnit::latest()->first();
            $amount = $concept->value * $currentUT->value;
        } elseif ($concept->description == 'SOLICITUD DE PATENTE DE INDUSTRIA Y COMERCIO') {
            $amount = $taxpayer->capital * $concept->value;
        }

        return $amount;
    }
}
