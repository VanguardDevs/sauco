<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permit extends Model
{
    use SoftDeletes;

    protected $table = 'permits';

    protected $guarded = [];

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function payment()
    {
        return $this->belongsToMany(Payment::class, Settlement::class);
    }
}
