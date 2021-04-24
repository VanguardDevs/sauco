<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use Carbon\Carbon;
use App\Traits\PrettyTimestamps;
use App\Traits\MakeLiquidation;
use App\Traits\PrettyAmount;
use App\Traits\PaymentUtils;
use App\Models\Concept;

class Affidavit extends Model implements Auditable
{
    use Audit, SoftDeletes, PrettyAmount, PrettyTimestamps, PaymentUtils, MakeLiquidation;

    protected $table = 'affidavits';

    protected $guarded = [];

    protected $casts = [
        'amount' => 'float'
    ];

    protected $with = [ 'month' ];

    protected $appends = ['total_amount', 'brute_amount_affidavit'];

    public static function processedByDate($firstDate, $lastDate)
    {
        return self::whereBetween('processed_at', [$firstDate->toDateString(), $lastDate->toDateString()])
            ->whereStateId(2)
            ->orderBy('processed_at', 'ASC')
            ->get();
    }

    public function shouldHaveFine()
    {
        $period = Carbon::parse($this->month->start_period_at);
        $lastMonth = new Carbon('first day of last month');
        $passedDays = $period->diffInDays($lastMonth);
        $today = Carbon::now();

        if ($passedDays >= 28) {
            return 2;
        }
        if ($today->day >= 16) {
            return 1;
        }

        return false;
    }

    public function nullAffidavit()
    {
        return $this->hasOne(NullAffidavit::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function economicActivityAffidavits()
    {
        return $this->hasMany(EconomicActivityAffidavit::class);
    }

    public function liquidation()
    {
        return $this->morphOne(Liquidation::class, 'liquidable');
    }

    public function scopeLastAffidavit($query)
    {
        return $query->latest()->first();
    }

    public function changeData($userId, $processed_at)
    {
        $date = Carbon::parse($processed_at);

        return $this->update(['user_id' => $userId, 'processed_at' => $date ]);
    }

    public function scopeFindOneByMonth($query, $taxpayer, $month)
    {
        return $query->whereTaxpayerId($taxpayer->id)
            ->whereMonthId($month->id);
    }

    public function getBruteAmountAffidavitAttribute($value)
    {
        $totalAffidavit = $this->economicActivityAffidavits->sum('brute_amount');

        return number_format($totalAffidavit, 2, ',', '.');
    }

    public function getTotalAmountAttribute($value)
    {
        return number_format($this->amount, 2, ',', '.');
    }

    public function fines()
    {
        return $this->belongsToMany(Fine::class, 'affidavit_fine');
    }
}
