<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\NewValue;
use Illuminate\Database\Eloquent\SoftDeletes;


class Credit extends Model
{
    use SoftDeletes, NewValue;

    protected $table = 'credits';

    protected $fillable = [
        'num',
        'amount',
        'taxpayer_id',
        'payment_id',
        'generated_at'
    ];


    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

}
