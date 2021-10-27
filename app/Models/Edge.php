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
        'type_id',
    ];

    public function fromNodeId() {
        return $this->hasOne(Node::class);
    }

    public function toNodeId() {
        return $this->hasOne(Node::class);
    }

    public function typeId() {
        return $this->hasOne(Type::class);
    }
}
