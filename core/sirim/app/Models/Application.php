<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use App\Models\Taxpayer;
use Carbon\Carbon;
use App\Traits\PrettyTimestamps;
use App\Traits\MakeLiquidation;
use App\Traits\PrettyAmount;
use App\Traits\PaymentUtils;

class Application extends Model implements Auditable
{
    use Audit, SoftDeletes, PrettyAmount, PrettyTimestamps, PaymentUtils, MakeLiquidation;

    protected $table = 'applications';

    protected $guarded = [];

    protected $casts = [
        'amount' => 'float'
    ];

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
