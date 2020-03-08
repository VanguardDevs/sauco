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
    
    public function reference()
    {
        return $this->hasOne(Reference::class);
    }

    public function receivables()
    {
        return $this->hasMany(Receivable::class);
    }

    public function settlements()
    {
        return $this->belongsToMany(Settlement::class, 'receivables');
    }

    public function taxpayer()
    {
        return $this->hasOneThrough(Taxpayer::class, Receivable::class, 'payment_id', 'id');
    }

    public function getNumAttribute()
    {
        return str_pad($this->attributes['id'], 8, '0',STR_PAD_LEFT);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:m:s', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y H:m', strtotime($value));
    }

    public function getTotalAmountAttribute()
    {
        return number_format($this->amount, 2, ',', '.')." Bs";
    }
}
