<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FillingStation extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function fuels()
    {
        return $this->belongsToMany(
            Fuel::class,
            'fuels_filling_stations',
            'filling_station_id',
            'fuel_id'
        );
    }
}
