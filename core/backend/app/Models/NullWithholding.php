<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NullDeduction extends Model
{
    protected $table = 'null_deductions';

    protected $fillable = [
        'reason',
        'user_id',
        'deduction_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function deduction()
    {
        return $this->hasOne(Deduction::class);
    }
}
