<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';

    protected $fillable = [
        'name',
        'account_type_id',
        'account_num',
        'description',
    ];

    public function references()
    {
        return $this->hasMany(Reference::class);
    }

    public function accountType()
    {
        return $this->belongsTo(AccountType::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Date('d/m/Y', strtotime($value));
    }
}
