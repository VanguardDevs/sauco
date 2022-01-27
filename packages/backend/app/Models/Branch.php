<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branches';

    protected $fillable = [
        'name',
        'sector_id'
    ];

    public function economicActivities()
    {
        return $this->hasMany(Branch::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
