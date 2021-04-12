<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use Carbon\Carbon;
use App\Traits\NewValue;
use App\Traits\PrettyAmount;
use App\Traits\PrettyTimestamps;
use App\Fine;

class Payment extends Model implements Auditable
{
    use Audit, SoftDeletes, NewValue, PrettyAmount, PrettyTimestamps;

    protected $table = 'payments';

    protected $guarded = [];

    protected $casts = [ 'amount' => 'float' ];

    public function checkForFine()
    {
        $totalFines = $this->affidavit()->first()->shouldHaveFine();
        $totalLiquidations = $this->liquidations()->count();

        if ($totalFines && $totalLiquidations < 3) {
            $concept = $totalFines[0];
            if (count($totalFines) == 2 && $totalLiquidations < 2) {
                // App\Modelsly two fines
                Fine::applyFine($this, $concept);
            }
            if (count($totalFines) == 1 || count($totalFines) == 2) {
                // App\Modelsly one fine
                Fine::applyFine($this, $concept);
            }
        }
        $this->updateAmount();
    }

    public function updateAmount()
    {
        $amount = $this->liquidations->sum('amount');

        return $this->update([ 'amount' => $amount ]);
    }

    public static function processedByDate($firstDate, $lastDate)
    {
        return self::whereBetween('processed_at', [$firstDate->toDateString(), $lastDate->toDateString()])
            ->whereStateId(2)
            ->orderBy('num', 'ASC')
            ->get();
    }

    public function nullPayment()
    {
        return $this->hasOne(NullPayment::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function reference()
    {
        return $this->hasOne(Reference::class);
    }

    public function liquidations()
    {
        return $this->belongsToMany(Liquidation::class, 'payment_liquidation');
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function affidavit()
    {
        return $this->liquidations()
            ->whereLiquidationTypeId(3);
    }

    public function fines()
    {
        return $this->belongsToMany(Fine::class, Liquidation::class);
    }

    public function invoiceModel()
    {
        return $this->belongsTo(InvoiceModel::class);
    }
}
