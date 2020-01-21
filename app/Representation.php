<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representation extends Model
{
    protected $table = 'representations';

    protected $fillable = [
        'document',
        'first_name',
        'second_name',
        'surname',
        'second_surname',
        'address',
        'phone',
        'email',
        'citizenship_id'
    ];

    public function citizenship()
    {
        return $this->belongsTo(Citizenship::class);
    }
}
