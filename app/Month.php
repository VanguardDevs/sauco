<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    protected $table = 'months';

    protected $fillable = [
        'name',
        'year_id'
    ];

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
