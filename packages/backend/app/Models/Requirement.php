<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\NewValue;


class Requirement extends Model
{
    use NewValue;

    protected $table = 'requirements';

    protected $fillable = [
        'name',
        'num',
        'concept_id',
    ];

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function taxpayers()
    {
        return $this->belongsToMany(Taxpayer::class, 'requirement_taxpayer');
    }
}
