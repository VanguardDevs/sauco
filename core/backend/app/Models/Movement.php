<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\PrettyAmount;
use App\Traits\PrettyTimestamps;

class Movement extends Model
{
    use HasFactory, PrettyAmount, PrettyTimestamps;

    protected $table = 'movements';

    protected $fillable = [
        'amount',
        'credit',
        'liquidation_id',
        'taxpayer_id',
        'user_id'
    ];

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function liquidation()
    {
        return $this->belongsTo(Liquidation::class);
    }
}
