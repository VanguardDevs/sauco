<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use App\Traits\PrettyTimestamps;
use App\Traits\NewValue;
use App\Traits\MakeLiquidation;
use App\Traits\PaymentUtils;

class License extends Model implements Auditable
{
    use Audit, SoftDeletes, PrettyTimestamps, MakeLiquidation, PaymentUtils;

    protected $table = 'licenses';

    protected $fillable = [
        'num',
        'active',
        'emission_date',
        'expiration_date',
        'taxpayer_id',
        'user_id',
        'representation_id',
        'correlative_id',
        'ordinance_id',
        'downloaded_at',
        'created_at',
        'liquidation_id'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function correlative()
    {
        return $this->belongsTo(Correlative::class);
    }

    public function ordinance()
    {
        return $this->belongsTo(Ordinance::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function economicActivities()
    {
        return $this->belongsToMany(EconomicActivity::class);
    }

    public function representation()
    {
        return $this->belongsTo(Representation::class);
    }

    public function liquidation()
    {
        return $this->belongsTo(Liquidation::class);
    }

    public function liqueur()
    {
        return $this->hasOne(Liqueur::class);
    }

    public function revenueStamp()
    {
        return $this->hasOne(RevenueStamp::class);
    }

    public function scopeGetLastLicense($query, Taxpayer $taxpayer)
    {
        if (self::whereTaxpayerId($taxpayer->id)->exists()) {
            return self;
        }

        return false;
    }

    public function getEmissionDateAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getExpirationDateAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public static function getNewNum($status = null)
    {
        $query = self::withTrashed()
            ->whereOrdinanceId(1);

        if ($status != null) {
            $query->whereStatusId($status);
        }

        $lastNum = '00000000';

        if ($query->count()) {
            $lastNum = $query->orderBy('num', 'DESC')->first()->num;
        }

        $newNum = str_pad($lastNum + 1, 8, '0', STR_PAD_LEFT);
        return $newNum;
    }
}
