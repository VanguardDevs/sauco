<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\NewValue;
use App\Traits\PrettyAmount;
use App\Traits\PrettyTimestamps;

class Movement extends Model
{
    use SoftDeletes, NewValue, PrettyAmount, PrettyTimestamps;

    protected $table = 'movements';

    protected $fillable = [
        'amount',
        'concurrent',
        'own_income',
        'concept_id',
        'liquidation_id',
        'year_id',
        'payment_id'
    ];

    protected $casts = [ 'amount' => 'float' ];

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function liquidation()
    {
        return $this->belongsTo(Liquidation::class);
    }
}
