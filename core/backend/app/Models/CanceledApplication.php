<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\PrettyTimestamps;

class CanceledApplication extends Model
{
    use HasFactory, PrettyTimestamps;

    protected $table = 'canceled_applications';

    protected $fillable = [
        'reason',
        'user_id',
        'application_id',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
