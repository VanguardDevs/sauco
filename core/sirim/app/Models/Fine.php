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

    public function affidavit()
    {
        return $this->belongsToMany(Affidavit::class, 'affidavit_fine');
    }
}
