<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;
    protected $table = 'properties';

    protected $fillable = [
        'num',
        'bulletin',
        'community_id',
        'street_id',
        'terrain_classification_id',
        'parish_id'
    ];

    public function uses()
    {
        $this->belongsToMany(Purpose::class, 'property_purpose');
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function parish()
    {
        return $this->belongsTo(Community::class);
    }

    public function terrainClassification()
    {
        return $this->belongsTo(TerrainClassification::class);
    }

    public function street()
    {
        return $this->belongsTo(Street::class);
    }

    public function taxpayers()
    {
        return $this->belongsToMany(Taxpayer::class, 'taxpayer_property');
    }
}
