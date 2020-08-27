<?php

namespace App;

use App\Settlement;
use App\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Fine extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'fines';

    protected $guarded = [];

    protected $casts = [
        'amount' => 'float'
    ];  

    public function nullFine()
    {
        return $this->hasOne(NullFine::class);
    }

    public function settlementHelpler($paymentId)
    {
        $payment = Payment::find($paymentId);

        $payment->settlements()->create([
            'num' => Settlement::newNum(),
            'object_payment' => self::concept()->first()->name,
            'fine_id' => $this->id
        ]);

        return $payment->updateAmount();
    }

    public static function calculateAmount($value, $concept)
    {
        if ($concept->chargingMethod->name == "TASA") {
            return $value * $concept->amount / 100;
        } 
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function payment()
    {
        return $this->belongsToMany(Payment::class, Settlement::class);
    }

    public function settlement()
    {
        return $this->hasOne(Settlement::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Date('d/m/Y H:m', strtotime($value));
    }
}
