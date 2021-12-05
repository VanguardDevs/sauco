<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    protected $table = 'signatures';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'active',
        'decree',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
