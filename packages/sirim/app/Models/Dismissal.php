<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PrettyTimestamps;

class Dismissal extends Model
{
    use PrettyTimestamps;

    protected $table = 'dismissals';

    protected $fillable = [
        'user_id',
        'taxpayer_id',
        'license_id',
        'dismissed_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function license()
    {
        return $this->belongsTo(License::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }
}
