<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisite extends Model
{
    protected $table = 'requisites';

    protected $fillable = [
        'description',
        'concept_id'
    ];

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }
}
