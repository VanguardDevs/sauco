<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CanceledLiquidation extends Model
{
    protected $table = 'canceled_liquidations';

    protected $fillable = [
        'user_id',
        'liquidation_id',
        'reason'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function liquidation()
    {
        return $this->belongsTo(Liquidation::class);
    }
}
