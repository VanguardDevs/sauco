<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Models\TaxUnit;
use App\Models\PetroPrice;

class Concept extends Model
{
    use SoftDeletes;

    protected $table = 'concepts';

    protected $fillable = [
        'code',
        'name',
        'amount',
        'charging_method_id',
        'liquidation_type_id',
        'ordinance_id',
        'accounting_account_id'
    ];

    public function calculateAmount($value = null)
    {
        $method = $this->chargingMethod()->first()->name;
        $value = $value ? $value : TaxUnit::latest()->first()->value;

        if ($method == "TASA") {
            if ($this->ordinance->name == 'ACTIVIDADES ECONÓMICAS') {
                return $value * $this->amount / 100;
            }
            $value = $value ? $value : PetroPrice::latest()->first()->value;

            return $value * $this->amount / 100;
        } else if ($method == 'DIVISA') {
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

    public function liquidationType()
    {
        return $this->belongsTo(liquidationType::class);
    }

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }

    public function accountingAccount()
    {
        return $this->belongsTo(AccountingAccount::class);
    }
}
