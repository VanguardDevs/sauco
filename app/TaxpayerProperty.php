<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxpayerProperty extends Model
{
    protected $table = 'taxpayer_property';

    protected $fillable = [
        'document',
        'property_id',
        'taxpayer_id',
        'ownership_state_id'
    ];

    public function ownershipState()
    {
        return $this->belongsTo(OwnershipState::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
