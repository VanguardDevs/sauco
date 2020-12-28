<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasRoles;

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

    public function withholdings()
    {
        return $this->hasMany(Withholding::class);
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
