<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\PrettyTimestamps;

class CanceledDeduction extends Model
{
    use HasFactory, PrettyTimestamps;

    protected $table = 'canceled_deductions';

    protected $fillable = [
        'reason',
        'user_id',
        'deduction_id',
    ];

    public function deduction()
    {
        return $this->belongsTo(Deduction::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
