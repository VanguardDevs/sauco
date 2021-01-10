<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;

class Representation extends Model implements Auditable
{
    use Audit;

    protected $table = 'representations';

    protected $fillable = [
        'taxpayer_id',
        'representation_type_id',
        'person_id'
    ];

    public function licenses()
    {
        return $this->hasMany(License::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function representationType()
    {
        return $this->belongsTo(RepresentationType::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
