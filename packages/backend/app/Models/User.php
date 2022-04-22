<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasRoles, HasFactory, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identity_card',
        'password',
        'full_name',
        'phone',
        'avatar',
        'login',
        'active'
    ];

    protected $hidden = [
        'password'
    ];

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

    public function movements()
    {
    	return $this->hasMany(Movement::class);
    }

    public function signature()
    {
        return $this->hasOne(Signature::class);
    }
}
