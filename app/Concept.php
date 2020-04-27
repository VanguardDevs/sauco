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
        'code',
        'name',
        'amount',
        'charging_method_id',
        'list_id',
        'ordinance_id'
    ];

    public function calculateAmount()
    {
        $method = $this->chargingMethod()->first()->name;
        $value = TaxUnit::latest()->first()->value;

        if ($method == 'DIVISA') {
            return $this->amount;
        } else if ($method == 'U.T') {
            return $this->amount * $value;
        }
    }

    public function ordinance()
    {
        return $this->belongsTo(Ordinance::class);
    }

    public function chargingMethod()
    {
        return $this->belongsTo(ChargingMethod::class);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'list_id');
    }

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }
}
