<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liqueur extends Model
{
    use HasFactory;

    protected $table = 'liqueurs';

    protected $fillable = [
        'work_hours',
        'company_id',
        'liqueur_parametre_id',
        'representation_id',
        'license_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function liqueur_parametre()
    {
        return $this->belongsTo(LiqueurParametre::class);
    }

    public function representation()
    {
        return $this->belongsTo(Representation::class);
    }

    public function license()
    {
        return $this->belongsTo(License::class);
    }

    public function liqueur_vehicle()
    {
        return $this->hasMany(LiqueurVehicle::class);
    }
}
