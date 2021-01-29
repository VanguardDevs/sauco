<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\PrettyTimestamps;

class CanceledFine extends Model
{
    use HasFactory, PrettyTimestamps;

    protected $table = 'canceled_fines';

    protected $fillable = [
        'reason',
        'user_id',
        'fine_id',
    ];

    public function fine()
    {
        return $this->belongsTo(Fine::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
