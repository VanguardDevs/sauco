<?php

namespace App;

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
        'parish_id'
    ];

    public function uses()
    {
        $this->belongsToMany(Purpose::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function parish()
    {
        return $this->belongsTo(Community::class);
    }

    public function street()
    {
        return $this->belongsTo(Street::class);
    }
}
