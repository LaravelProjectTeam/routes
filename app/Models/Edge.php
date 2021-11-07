<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edge extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_node_id',
        'to_node_id',
        'minutes_needed',
        'type_id',
    ];

    public function from() {
        return $this->belongsTo(Node::class, 'from_node_id');
    }

    public function to() {
        return $this->belongsTo(Node::class, 'to_node_id');
    }

    public function type() {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
