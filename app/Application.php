<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;

class Application extends Model implements Auditable
{
    use Audit;
    use SoftDeletes;

    protected $table = 'applications';

    protected $fillable = [
        'num',
        'application_state_id',
        'settlement_id'
    ];

    public function settlement()
    {
        return $this->belongsTo(Settlement::class);
    }

    public function applicationState()
    {
        return $this->belongsTo(ApplicationState::class);
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public static function getNum()
    {
        if (self::lastApplication()->count()) {
            $lastNum = self::lastApplication()->num;
            $newNum = ltrim($lastNum, 0) + 1;
            $newNum = str_pad($newNum, 8, "0", STR_PAD_LEFT);
        } else {
            $newNum = "00000001";
        }

        return $newNum;
    }

    public function scopeLastApplication($query)
    {
        return $query->withTrashed()->latest()->first();
    }
}
