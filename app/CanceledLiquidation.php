<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PrettyTimestamps;

class CanceledLiquidation extends Model
{
    use PrettyTimestamps;

    protected $table = 'canceled_liquidations';

    protected $fillable = [
        'user_id',
        'liquidation_id',
        'reason'
    ];

    public function taxpayer()
    {
        return $this->liquidation()->first()->taxpayer();
    }

    public function status()
    {
        return $this->liquidation()->first()->status();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function liquidation()
    {
        return $this->belongsTo(Liquidation::class)
            ->withTrashed();
    }
}
