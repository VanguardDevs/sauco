<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;

class Property extends Model implements Auditable
{
    use Audit;
    use SoftDeletes;

    protected $table = 'properties';

    protected $fillable = Array(
        'local',
        'street',
        'floor',
        'cadastre_num',
        'contract',
        'document',
        'bulletin',
        'land_valuation',
        'ownership_status_id',
        'taxpayer_id',
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

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }
}
