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

    public function getMinutesNeededAttribute() {
        // 1# s = v.t => 2# t = s/v
        // formula: #2 + hardship_level / 10

        $road_type = RoadType::findOrFail($this->type_id);

        //(1 to 5) * 2; 5 to 10 * 1.75
        $hardship_modifier = $road_type->hardship_level <= 5 ?
            ($road_type->hardship_level * 2) :
            ($road_type->hardship_level * 1.75);

        return ($this->distance_in_km / $this->max_speed) * 60 + $hardship_modifier;
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
