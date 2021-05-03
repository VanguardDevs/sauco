<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\PrettyTimestamps;

class Cancellation extends Model
{
    use PrettyTimestamps;

    protected $table = 'cancellations';

    protected $fillable = [
        'reason',
        'user_id',
        'cancellable_type',
        'cancellable_id',
    ];

    public function taxpayer()
    {
        return $this->liquidation()->first()->taxpayer();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cancellable()
    {
        return $this->morphTo()->withTrashed();
    }
}
