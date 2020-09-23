<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NullFine extends Model
{
    protected $table = 'null_fines';

    protected $fillable = [
        'reason',
        'user_id',
        'fine_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fine()
    {
        return $this->belongsTo(Fine::class)->withTrashed();
    }

    public function taxpayer()
    {
        return $this->fine->taxpayer();
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:i', strtotime($value));
    }
}
