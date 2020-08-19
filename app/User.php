<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndPermissions, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identity_card',
        'first_name',
        'password',
        'surname',
        'phone',
        'avatar',
        'login'
    ];

    protected $appends = [
        'full_name'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

    public function withholdings()
    {
        return $this->hasMany(Withholding::class);
    }

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'].' '.
            $this->attributes['surname'];
    }

    public function affidavits()
    {
	return $this->hasMany(Affidavit::class);
    }
}
