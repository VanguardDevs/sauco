<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use App\Traits\PrettyTimestamps;

class License extends Model implements Auditable
{
    use Audit, SoftDeletes, PrettyTimestamps;

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
        'downloaded_at'
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

    public function economicActivities()
    {
        return $this->belongsToMany(EconomicActivity::class);
    }

    public function representation()
    {
        return $this->belongsTo(Representation::class);
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
}
