<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EconomicActivity extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'economic_activities';

    protected $fillable = [
        'code',
        'name',
        'description',
        'aliquote',
        'active',
        'min_tax',
    ];

    protected $casts = [
        'aliquote' => 'float',
        'min_tax' => 'integer'
    ];

    public function licenses()
    {
        return $this->belongsToMany(License::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'economic_activity_company');
    }

    public function getFullNameAttribute()
    {
        return "{$this->code} - {$this->attributes['name']}";
    }
}
