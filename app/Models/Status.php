<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    
    protected $guarded = [];
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    } 

    public function liquidations()
    {
        return $this->hasMany(Liquidation::class);
    }
}
