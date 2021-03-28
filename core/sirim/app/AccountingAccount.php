<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountingAccount extends Model
{
    protected $table = 'accounting_accounts';
    
    public $fillable = [
        'name'
    ];

    public function concepts()
    {
        return $this->hasMany(Concept::class);
    }
}
