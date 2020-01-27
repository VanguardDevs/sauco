<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;

    protected $table = 'properties';

    protected $fillable = Array(
        'local',
        'street',
        'floor',
        'cadastre_num',
        'contract',
        'document',
        'ownership_statuses_id',
        'taxpayer_id',
        'community_id',
        'property_type_id'
    );

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function ownershipStatus()
    {
        return $this->belongsTo(OwnershipStatus::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }
}
