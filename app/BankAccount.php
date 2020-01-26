<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'bank_accounts';

    protected $fillable = [
        'bank_name',
        'bank_account_type_id',
        'account_num',
        'description',
        'budget_account',
        'accounting_account',
    ];

    public function bankAccountType()
    {
        return $this->belongsTo(BankAccountType::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Date('d/m/Y', strtotime($value));
    }
}
