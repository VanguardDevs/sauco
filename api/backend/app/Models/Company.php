<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'address',
        'capital',
        'principal',
        'num_workers',
        'constitution_date',
        'parish_id',
        'community_id',
        'taxpayer_id',
        'phone',
        'email'
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
