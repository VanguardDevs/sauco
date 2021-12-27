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
        'num',
        'case_file',
        'volume',
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

    public function representations()
    {
        return $this->hasMany(Representation::class);
    }

    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function movements()
    {
        return $this->morphMany(Movement::class, 'ownable')
            ->withTrashed();
    }

    public function applications()
    {
        return $this->morphMany(Movement::class, 'ownable')
            ->withTrashed();
    }

    public function licenses()
    {
        return $this->morphMany(License::class, 'ownable')
            ->withTrashed();
    }

    public function fines()
    {
        return $this->morphMany(Fine::class, 'ownable')
            ->withTrashed();
    }

    public function liquidations()
    {
        return $this->morphMany(Liquidation::class, 'ownable')
            ->withTrashed();
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'ownable')
            ->withTrashed();
    }

    public function economicActivities()
    {
        return $this->belongsToMany(EconomicActivity::class, 'economic_activity_company');
    }
}
