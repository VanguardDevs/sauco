<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NullWithholding extends Model
{
    protected $table = 'null_withholdings';

    protected $fillable = [
        'reason',
        'user_id',
        'withholding_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function withholding()
    {
        return $this->hasOne(Withholding::class);
    }
}
