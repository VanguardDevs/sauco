<?php

namespace App\Models;

use App\Models\Settlement;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as Audit;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use App\Traits\PrettyTimestamps;
use App\Traits\MakeLiquidation;
use App\Traits\PrettyAmount;
use App\Traits\PaymentUtils;

class Fine extends Model implements Auditable
{
    use Audit, SoftDeletes, PrettyAmount, PrettyTimestamps, PaymentUtils, MakeLiquidation;

    protected $table = 'fines';

    protected $guarded = [];

    protected $casts = [
        'amount' => 'float'
    ];

    public function nullFine()
    {
        return $this->hasOne(NullFine::class);
    }

    public static function applyFine($payment, $concept)
    {
        $amount = $payment->settlements()->whereNotNull('affidavit_id')->first()->amount;
        $fineAmount = $concept->calculateAmount($amount);
        $userId = User::whereLogin('sauco')->first()->id;

        $fine = $concept->fines()->create([
            'amount' => $fineAmount,
            'active' => true,
            'taxpayer_id' => $payment->taxpayer_id,
            'user_id' => $userId
        ]);

        $fine->settlement()->create([
            'num' => Settlement::newNum(),
            'object_payment' => $concept->name,
            'amount' => $fineAmount,
            'taxpayer_id' => $payment->taxpayer_id,
            'payment_id' => $payment->id,
        ]);
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

    public function liquidation()
    {
        return $this->morphOne(Liquidation::class, 'liquidable');
    }
}
