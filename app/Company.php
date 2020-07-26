<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'capital',
        'num_workers',
        'taxpayer_id'
    ];

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }
}
