<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Road extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'from_town_id',
        'to_town_id',
        'road_type_id',
        'max_speed_in_km_per_hour',
        'distance_in_km'
    ];

    public function getMinutesNeededAttribute()
    {
        $road_type = RoadType::findOrFail($this->road_type_id);

        $base_minutes_needed = ($this->distance_in_km / $this->max_speed_in_km_per_hour) * 60;

        return ($base_minutes_needed * $road_type->hardship_level) / 50 + $base_minutes_needed;
    }

    public function fillingStations()
    {
        return $this->hasMany(FillingStation::class, 'road_id', 'id');
    }

    public function from()
    {
        return $this->belongsTo(Town::class, 'from_town_id');
    }

    public function to()
    {
        return $this->belongsTo(Town::class, 'to_town_id');
    }

    public function roadType()
    {
        return $this->belongsTo(RoadType::class, 'road_type_id');
    }
}
