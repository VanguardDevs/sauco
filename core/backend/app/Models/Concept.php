<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Traits\NewValue;
use App\TaxUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\PrettyAmount;

class Concept extends Model
{
    use SoftDeletes, NewValue, HasFactory, PrettyAmount;

    protected $table = 'concepts';

    protected $fillable = [
        'code',
        'name',
        'min_amount',
        'max_amount',
        'charging_method_id',
        'liquidation_type_id',
        'ordinance_id',
        'interval_id',
        'accounting_account_id'
    ];

    protected $casts = [
        'amount' => 'float',
    ];

    public function calculateAmount($value = null)
    {
        $method = $this->chargingMethod()->first()->name;
        $value = $value ? $value : TaxUnit::latest()->first()->value;

        if ($method == "TASA") {
            return $value * $this->min_amount / 100;
        } else if ($method == 'DIVISA') {
            return $this->min_amount;
        } else if ($method == 'U.T') {
            return $this->min_amount * $value;
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
        return $this->belongsTo(LiquidationType::class);
    }

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }

    public function requirement()
    {
        return $this->belongsToMany(Requirement::class);
    }

    public function accountingAccount()
    {
        return $this->belongsTo(AccountingAccount::class);
    }

    public function interval()
    {
        return $this->belongsTo(Interval::class);
    }

    public function liquidations()
    {
        return $this->hasMany(Liquidation::class);
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}
