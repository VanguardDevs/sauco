<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;

class Payment extends Model implements Auditable
{
    use Audit;
    use SoftDeletes;

    protected $table = 'payments';

    protected $guarded = [];
 
    protected $casts = [
        'amount' => 'float'
    ];  

    protected $appends = ['num'];

    public function state()
    {
        return $this->belongsTo(Status::class);
    }
 
    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
    
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
    
    public function references()
    {
        return $this->hasMany(Reference::class);
    }

    public function receivables()
    {
        return $this->hasMany(Receivable::class);
    }

    public function getNumAttribute()
    {
        return str_pad($this->attributes['id'], 8, '0',STR_PAD_LEFT);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:m:s', strtotime($value));
    }

    public function settlements()
    {
        return $this->belongsTo(Settlement::class, Receivable::class);
    }
}
