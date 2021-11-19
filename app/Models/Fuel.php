<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name'
    ];

    public function fillingStations()
    {
        return $this->belongsToMany(
            FillingStation::class,
            'fuels_filling_stations',
            'fuel_id',
            'filling_station_id'
        );
    }
}
