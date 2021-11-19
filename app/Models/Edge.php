<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edge extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'from_node_id',
        'to_node_id',
        'type_id',
        'max_speed',
        'distance_in_km'
    ];

    public function getMinutesNeededAttribute()
    {
        $road_type = RoadType::findOrFail($this->type_id);

        $base_minutes_needed = ($this->distance_in_km / $this->max_speed) * 60;

        return ($base_minutes_needed * $road_type->hardship_level) / 50 + $base_minutes_needed;
    }

    public function fillingStations()
    {
        return $this->hasMany(FillingStation::class, 'edge_id', 'id');
    }

    public function from()
    {
        return $this->belongsTo(Node::class, 'from_node_id');
    }

    public function to()
    {
        return $this->belongsTo(Node::class, 'to_node_id');
    }

    public function roadType()
    {
        return $this->belongsTo(RoadType::class, 'type_id');
    }
}
