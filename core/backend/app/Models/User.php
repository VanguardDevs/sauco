<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable, HasRoles, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dni',
        'first_name',
        'password',
        'surname',
        'phone',
        'avatar',
        'login'
    ];

    protected $appends = [ 'full_name' ];

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'].' '.
            $this->attributes['surname'];
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function liquidations()
    {
        return $this->hasMany(Liquidation::class);
    }

    public function deductions()
    {
        return $this->hasMany(Deduction::class);
    }

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }

    public function affidavits()
    {
    	return $this->hasMany(Affidavit::class);
    }
}
