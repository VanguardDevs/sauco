<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representation extends Model
{
    protected $table = 'representations';

    protected $fillable = [
        'document',
        'first_name',
        'second_name',
        'surname',
        'second_surname',
        'address',
        'phone',
        'email',
        'citizenship_id',
        'taxpayer_id'
    ];

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

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
