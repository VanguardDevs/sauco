<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use Carbon\Carbon;
use App\Traits\NewValue;
use App\Traits\PrettyTimestamps;
use App\Traits\MakeLiquidation;
use App\Traits\PaymentUtils;
use App\Models\Concept;

class Affidavit extends Model implements Auditable
{
    use SoftDeletes, Audit, PrettyTimestamps, NewValue, MakeLiquidation, PaymentUtils;

    protected $table = 'affidavits';

    protected $fillable = [
        'total_calc_amount',
        'total_brute_amount',
        'taxpayer_id',
        'user_id',
        'processed_at',
        'month_id'
    ];

    protected $with = [ 'month' ];

    public static function processedByDate($firstDate, $lastDate)
    {
        return self::whereBetween('processed_at', [$firstDate->toDateString(), $lastDate->toDateString()])
            ->whereStateId(2)
            ->orderBy('processed_at', 'ASC')
            ->get();
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

    public function getTotalBruteAmountAffidavitAttribute($value)
    {
        return number_format('total_brute_amount', 2, ',', '.');
    }

    public function cancellations()
    {
        return $this->morphMany(Cancellation::class, 'cancellable');
    }

    public function fines()
    {
        return $this->belongsToMany(Fine::class, 'affidavit_fine');
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
        return $this->morphOne(Liquidation::class, 'liquidable')
            ->withTrashed();
    }
}
