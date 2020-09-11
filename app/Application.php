<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Taxpayer;
use Carbon\Carbon;

class Application extends Model
{
    use SoftDeletes;

    protected $table = 'applications';

    protected $guarded = [];

    protected $casts = [
        'amount' => 'float'
    ];

    public function nullApplication()
    {
        return $this->hasOne(NullApplication::class);
    }

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
        return $this->hasOne(Liquidation::class, 'model_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Date('d/m/Y H:m', strtotime($value));
    }
}
