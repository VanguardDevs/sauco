<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FineState extends Model
{
    protected $table = 'fine_states';

    protected $fillable = [
        'description'
    ];

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }
}
