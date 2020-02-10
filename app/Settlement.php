<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settlement extends Model
{
    use SoftDeletes;

    protected $table = 'settlements';

    protected $fillable = [
        'num',
        'amount',
        'payment_id',
        'concept_id',
        'taxpayer_id',
        'month_id'
    ];

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function application()
    {
        return $this->hasOne(Application::class);
    }

    public function fine()
    {
        return $this->hasOne(Fine::class);
    }

    public static function getNum()
    {
        if (self::lastSettlement()->count()) {
           $lastNum = self::lastSettlement()->num;
           $newNum = ltrim($lastNum, "0") + 1;
           $newNum  = str_pad($newNum, 8, "0", STR_PAD_LEFT);
        } else {
            $newNum = "00000001";
        }
        return $newNum;
    }

    public function scopeLastSettlement($query)
    {
        return $query->withTrashed()->latest()->first();
    }
}
