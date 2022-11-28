<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndPermissions, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identity_card',
        'full_name',
        'password',
        'phone',
        'avatar',
        'login'
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

    public function licenses()
    {
        return $this->hasMany(License::class);
    }

    public function affidavits()
    {
    	return $this->hasMany(Affidavit::class);
    }

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }

        public function revenueStamps()
    {
        return $this->hasMany(RevenueStamp::class);
    }
}
