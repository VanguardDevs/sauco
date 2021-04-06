<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceModel extends Model
{
    protected $table = 'invoice_models';

    protected $fillable = [
        'name', 'description', 'code'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
