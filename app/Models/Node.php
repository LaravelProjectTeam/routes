<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name',
    ];

    public function edge()
    {
        return $this->hasOne(Edge::class, 'edge_id');
    }
}
