<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'address',
        'capital',
        'num_workers',
        'parish_id',
        'community_id',
        'parish_id',
        'taxpayer_id'
    ];

    public function affidavits()
    {
        return $this->hasMany(Affidavit::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function economicActivities()
    {
        return $this->belongsToMany(EconomicActivity::class);
    }

    public function payments()
    {
        return $this->belongsToMany(Payment::class);
    }
}
