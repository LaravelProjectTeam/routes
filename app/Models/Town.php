<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name',
    ];

    public function road()
    {
        return $this->hasOne(Road::class, 'road_id');
    }
}
