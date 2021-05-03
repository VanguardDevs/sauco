<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use App\Traits\PrettyAmount;
use App\Traits\NewValue;
use App\Traits\PrettyTimestamps;
use App\Traits\MakeLiquidation;
use App\Traits\PaymentUtils;

class Permit extends Model implements Auditable
{
    use SoftDeletes, PrettyAmount, Audit, PrettyTimestamps, NewValue, MakeLiquidation, PaymentUtils;

    protected $table = 'permits';

    protected $fillable = [
        'num',
        'amount',
        'active',
        'valid_until',
        'concept_id',
        'user_id',
        'taxpayer_id'
    ];

    protected $casts = [ 'amount' => 'float' ];

    protected $appends = [ 'pretty_amount' ];

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function liquidation()
    {
        return $this->hasOne(Liquidation::class);
    }

    public function cancellations()
    {
        return $this->morphMany(Cancellation::class, 'cancellable');
    }
}
