<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;

class Payment extends Model implements Auditable
{
    use Audit;
    use SoftDeletes;

    protected $table = 'payments';

    protected $fillable = [
        'num',
        'amount',
        'total_amount',
        'payment_state_id',
        'payment_type_id',
        'user_id'
    ];

    public function paymentState()
    {
        return $this->belongsTo(PaymentState::class);
    }

    public function user()
    {
        return $this->belongsTo(Payment::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function references()
    {
        return $this->hasMany(Reference::class);
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class, Settlement::class);
    }

    public static function getNum()
    {
        if (self::lastPayment()->count()) {
            $lastNum = Payment::lastPayment()->num;
            $newNum = ltrim($lastNum, "0") + 1; // Lastnum + 1
            $payNum = str_pad($newNum,8,"0",STR_PAD_LEFT);
        } else {
            $payNum = "00000001";
        }
        return $payNum;
    }

    public function scopeLastPayment($query)
    {
        return $query->withTrashed()->latest()->first();
    }
}
