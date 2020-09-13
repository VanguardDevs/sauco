<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use Carbon\Carbon;
use App\Concept;
use App\Traits\PrettyTimestamps;
use App\Traits\PrettyAmount;

class Affidavit extends Model implements Auditable
{
    use Audit, SoftDeletes, PrettyTimestamps, PrettyAmount;

    protected $table = 'affidavits';

    protected $guarded = [];

    protected $casts = [ 'amount' => 'float' ];

    protected $with = [ 'month' ];

    protected $appends = [
        'pretty_amount',
        'brute_amount_affidavit'
    ];

    /**
    * Check if this affidavit fills an exception for fine
    * 
     */
    public function hasException()
    {
        if ($this->taxpayer->hasException()) {
            return true;
        }

        return false;
    }

    public function shouldHaveFine()
    {
        if (!$this->hasException()) {
            $startPeriod = Carbon::parse($this->month->start_period_at);
            $todayDate = Carbon::now();
            $passedDays = $startPeriod->diffInDays($todayDate);

            if ($passedDays > 60) {
                return [
                    Concept::whereCode(3)->first(),
                    Concept::whereCode(3)->first(),
                ]; 
            } else if ($passedDays > 45) {
               return [Concept::whereCode(3)->first()]; 
            }
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

    public function payment()
    {
        $liquidation = $this->liquidation;

        return $liquidation->payment()->first();
    }

    public function withholding()
    {
        return $this->belongsToMany(Withholding::class);
    }

    public function processedPayment()
    {
        return $this->belongsToMany(Payment::class, Liquidation::class)->first();
    }

    public function liquidation()
    {
        return $this->hasOne(Liquidation::class, 'model_id')
            ->whereLiquidationTypeId(3);
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
}
