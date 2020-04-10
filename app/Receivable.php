<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;

class Receivable extends Model implements Auditable
{
    use SoftDeletes;
    use Audit;

    protected $table = 'receivables';

    protected $guarded = [];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function getTotalAmountAttribute($value)
    {
        return number_format($this->amount, 2, ',', '.');
    }

    public static function newNum()
    {
        $lastNum = Receivable::withTrashed()
            ->orderBy('num','DESC')
            ->first()
            ->num;

        $newNum = str_pad($lastNum + 1, 8, '0', STR_PAD_LEFT);
        return $newNum;
    }   
}
