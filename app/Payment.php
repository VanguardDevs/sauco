<?php

namespace App;

use App\Taxpayer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use Carbon\Carbon;

class Payment extends Model implements Auditable
{
    use Audit;
    use SoftDeletes;

    protected $table = 'payments';

    protected $guarded = [];
 
    protected $casts = [
        'amount' => 'float'
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

    public function getNumAttribute()
    {
        return str_pad($this->attributes['id'], 8, '0',STR_PAD_LEFT);
    }

    public static function scopeList()
    {
        return DB::table('taxpayers') 
            ->join('settlements', 'taxpayers.id', '=', 'settlements.taxpayer_id')
            ->join('receivables', 'receivables.settlement_id', 'settlements.id')
            ->join('payments', 'receivables.payment_id', '=', 'payments.id')
            ->join('status', 'payments.state_id', '=', 'status.id')
            ->select([
                'taxpayers.name as taxpayers.name',
                'taxpayers.rif as taxpayers.rif',
                'status.name as status.name',
                'payments.amount as payments.amount',
                'payments.id',
            ]);
    }

    public static function processedByDate()
    {
        return self::whereDate('updated_at', Carbon::yesterday()->toDateString())
            ->whereStateId(2)
            ->get();
    } 

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:m:s', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y H:m', strtotime($value));
    }

    public function getTotalAmountAttribute()
    {
        return number_format($this->amount, 2, ',', '.')." Bs";
    }
}
