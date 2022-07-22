<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use App\Traits\NewValue;
use App\Traits\PrettyAmount;
use App\Traits\PrettyTimestamps;
use Carbon\Carbon;
use App\Models\Year;

class Liquidation extends Model implements Auditable
{
    use SoftDeletes, Audit, NewValue, PrettyAmount, PrettyTimestamps;

    protected $table = 'liquidations';

    protected $guarded = [];

    protected $casts = ['amount' => 'float' ];

    protected $appends = ['pretty_amount'];

    /**
    * Return year for the movement
    */
    public function year()
    {
        $type = $this->liquidation_type_id;

        if ($type == 3) {
            return $this->liquidable->month->year()->first();
        }
        return Year::where('year', '=', Carbon::now()->year)->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function liquidationType()
    {
        return $this->belongsTo(LiquidationType::class);
    }

    public function cancellations()
    {
        return $this->morphMany(Cancellation::class, 'cancellable');
    }

    public function liquidable()
    {
        return $this->morphTo()->withTrashed();
    }

    public function payment()
    {
        return $this->belongsToMany(Payment::class, 'payment_liquidation');
    }

    public function deduction()
    {
        return $this->hasOne(Deduction::class);
    }

    public function movement()
    {
    	return $this->hasOne(Movement::class);
    }

    public function license()
    {
    	return $this->hasOne(License::class);
    }

    public function requirementTaxpayer()
    {
    	return $this->hasOne(RequirementTaxpayer::class);
    }

    public function credit()
    {
    	return $this->hasOne(Credit::class);
    }
}
