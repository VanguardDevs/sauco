<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    
    protected $guarded = [];
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    } 

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }
}
