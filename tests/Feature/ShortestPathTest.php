<?php

namespace Tests\Feature;

use App\Models\Edge;
use App\Models\Node;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShortestPathTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        // create some towns
//        $sofia = Node::create(['name' => "Sofia"]);
//        $pleven = Node::create(['name' => "Pleven"]);
//        $burgas = Node::create(['name' => "Burgas"]);
//        $plovdiv = Node::create(['name' => "Plovdiv"]);
//
//        // todo: change type_id
//        Edge::create(["from_node_id" => $plovdiv->id, "to_node_id" => $burgas->id, "minutes_needed"=> 5, "type_id" => 0]);
//        Edge::create(["from_node_id" => $sofia->id, "to_node_id" => $pleven->id, "minutes_needed"=> 5, "type_id" => 0]);
//        Edge::create(["from_node_id" => $sofia->id, "to_node_id" => $pleven->id, "minutes_needed"=> 5, "type_id" => 0]);
//        Edge::create(["from_node_id" => $sofia->id, "to_node_id" => $pleven->id, "minutes_needed"=> 5, "type_id" => 0]);


        $this->assertTrue(true);
    }
}
