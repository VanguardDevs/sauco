<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EconomicActivitySettlement extends Model
{
    use SoftDeletes;

    protected $table = 'economic_activity_settlements';

    protected $fillable = [
        'num',
        'description',
        'payment_id',
        'economic_activity_id',
        'economic_activity_license_id',
        'month_id'
    ];

    public function economicActivity()
    {
        return $this->belongsTo(EconomicActivity::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function economicActivityLicense()
    {
        return $this->belongsTo(EconomicActivityLicense::class);
    }
}
