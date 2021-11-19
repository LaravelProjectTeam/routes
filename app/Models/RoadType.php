<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadType extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'hardship_level'
    ];

    public function road()
    {
        return $this->belongsToMany(Road::class);
    }
}
