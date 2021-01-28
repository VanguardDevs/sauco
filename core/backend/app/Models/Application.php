<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Taxpayer;
use Carbon\Carbon;
use App\Traits\PrettyAmount;
use App\Traits\NewValue;
use App\Traits\PrettyTimestamps;
use App\Traits\MakeLiquidation;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;

class Application extends Model implements Auditable
{
    use SoftDeletes, PrettyAmount, Audit, PrettyTimestamps, MakeLiquidation, NewValue;

    protected $table = 'applications';

    protected $fillable = [
        'amount',
        'taxpayer_id',
        'concept_id',
        'approved_at',
        'active'
    ];

    protected $casts = [ 'amount' => 'float' ];

    protected $appends = [ 'pretty_amount' ];

    public static function hasPaid(Taxpayer $taxpayer, $code)
    {
        $application = $taxpayer
            ->applications()
            ->whereBetween('created_at', [Carbon::now()->subYear(1), Carbon::now()])
            ->whereHas('concept', function ($concept) use ($code) {
                return $concept->whereCode($code);
            })->latest()->first();

        if ($application) {
            $payment = $application->payment()->first();

            if (!$payment) {
                return false;
            }

            if ($payment->state_id == 2) {
                return true;
            }
        }

        return false;
    }

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

    public function payment()
    {
        return $this->belongsToMany(Payment::class, Liquidation::class);
    }

    public function liquidation()
    {
        return $this->morphOne(Liquidation::class, 'liquidable')
            ->withTrashed();
    }

    public function getNull()
    {
        return $this->hasOne(NullApplication::class);
    }
}
