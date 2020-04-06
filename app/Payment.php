<?php

namespace App;

use App\Taxpayer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;

class Payment extends Model implements Auditable
{
    use Audit;
    use SoftDeletes;

    protected $table = 'payments';

    protected $guarded = [];
 
    protected $casts = [
        'amount' => 'float'
    ];  

    protected $appends = [
        'total_amount',
    ];

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

    public function receivables()
    {
        return $this->hasMany(Receivable::class);
    }
    
    public function settlements()
    {
        return $this->belongsToMany(Settlement::class, 'receivables');
    }

    public static function scopeList()
    {
        return Taxpayer::join('settlements', 'taxpayers.id', '=', 'settlements.taxpayer_id')
            ->join('receivables', 'receivables.settlement_id', 'settlements.id')
            ->join('payments', 'receivables.payment_id', '=', 'payments.id')
            ->join('status', 'payments.state_id', '=', 'status.id')
            ->groupBy('payments.id', 'taxpayers.name', 'taxpayers.rif', 'status.name')
            ->select([
                'taxpayers.name as taxpayers.name',
                'taxpayers.rif as taxpayers.rif',
                'status.name as status.name',
                'payments.amount as payments.amount',
                'payments.deleted_at as payments.deleted_at',
                'payments.id',
                'payments.num',
                'payments.processed_at'
            ]);
    }

    public static function processedByDate($date)
    {
        return self::whereDate('processed_at', $date->toDateString())
            ->whereStateId(2)
            ->orderBy('processed_at', 'ASC')
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

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:m:s', strtotime($value));
    }

    public function getProcessedAtAttribute($value)
    {
        return date('d-m-Y H:m', strtotime($value));
    }

    public function getTotalAmountAttribute()
    {
        return number_format($this->amount, 2, ',', '.')." Bs";
    }
}
