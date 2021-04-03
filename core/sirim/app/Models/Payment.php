<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use Carbon\Carbon;
use App\Fine;

class Payment extends Model implements Auditable
{
    use Audit;
    use SoftDeletes;

    protected $table = 'payments';

    protected $guarded = [];

    protected $casts = [ 'amount' => 'float' ];

    protected $appends = [ 'formatted_amount' ];

    public function checkForFine()
    {
        $totalFines = $this->affidavit()->first()->shouldHaveFine();
        $totalSettlements = $this->settlements()->count();

        if ($totalFines && $totalSettlements < 3) {
            $concept = $totalFines[0];
            if (count($totalFines) == 2 && $totalSettlements < 2) {
                // Apply two fines
                Fine::applyFine($this, $concept);
            }
            if (count($totalFines) == 1 || count($totalFines) == 2) {
                // Apply one fine
                Fine::applyFine($this, $concept);
            }
        }
        $this->updateAmount();
    }

    public function updateAmount()
    {
        $amount = $this->settlements->sum('amount');

        return $this->update([ 'amount' => $amount ]);
    }

    public static function processedByDate($firstDate, $lastDate)
    {
        return self::whereBetween('processed_at', [$firstDate->toDateString(), $lastDate->toDateString()])
            ->whereStateId(2)
            ->orderBy('num', 'ASC')
            ->get();
    }

    public static function newNum()
    {
        $lastNum = Payment::withTrashed()
            ->whereStateId(2)
            ->orderBy('num', 'DESC')
            ->first()
            ->num;

        $newNum = str_pad($lastNum + 1, 8, '0', STR_PAD_LEFT);
        return $newNum;
    }

    public function nullPayment()
    {
        return $this->hasOne(NullPayment::class);
    }

    public function state()
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

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
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
        return $this->belongsToMany(Affidavit::class, Settlement::class);
    }

    public function fines()
    {
        return $this->belongsToMany(Fine::class, Settlement::class);
    }

    public function invoiceModel()
    {
        return $this->belongsTo(InvoiceModel::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:m', strtotime($value));
    }

    public function getProcessedAtAttribute($value)
    {
        return date('d/m/Y h:i', strtotime($value));
    }

    public function getDeletedAtAttribute($value)
    {
        return date('d/m/Y H:m', strtotime($value));
    }

    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 2, ',', '.');
    }
}
