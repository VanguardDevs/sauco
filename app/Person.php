<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;

class People extends Model implements Auditable
{
    use Audit;

    protected $table = 'people';

    protected $fillable = [
        'document',
        'first_name',
        'second_name',
        'surname',
        'second_surname',
        'address',
        'phone',
        'email',
        'citizenship_id'
    ];

    public function citizenship()
    {
        return $this->belongsTo(Citizenship::class);
    }

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->second_name} {$this->surname} {$this->second_surname}";
    }

    public function getAddressAttribute()
    {
        return $this->address ?? 'NO REGISTRADO';
    }

    public function getPhoneAttribute()
    {
        return $this->phone ?? 'NO REGISTRADO';
    }

    public function getEmailAttribute()
    {
        return $this->email ?? 'NO REGISTRADO';
    }
}
