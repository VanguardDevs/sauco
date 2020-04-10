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

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function settlement()
    {
        return $this->belongsToMany(Settlement::class);
    }

    public function fine()
    {
        return $this->belongsToMany(Fine::class);
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

    public function getDeletedAtAttribute($value)
    {
        return date('d-m-Y H:m', strtotime($value));
    }

    public function getTotalAmountAttribute()
    {
        return number_format($this->amount, 2, ',', '.')." Bs";
    }
}
