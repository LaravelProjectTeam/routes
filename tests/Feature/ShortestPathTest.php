<?php

namespace Tests\Feature;

use App\Models\Road;
use App\Models\Town;
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
//        $sofia = Town::create(['name' => "Sofia"]);
//        $pleven = Town::create(['name' => "Pleven"]);
//        $burgas = Town::create(['name' => "Burgas"]);
//        $plovdiv = Town::create(['name' => "Plovdiv"]);
//
//        // todo: change type_id
//        Edge::create(["from_node_id" => $plovdiv->id, "to_node_id" => $burgas->id, "minutes_needed"=> 5, "type_id" => 0]);
//        Edge::create(["from_node_id" => $sofia->id, "to_node_id" => $pleven->id, "minutes_needed"=> 5, "type_id" => 0]);
//        Edge::create(["from_node_id" => $sofia->id, "to_node_id" => $pleven->id, "minutes_needed"=> 5, "type_id" => 0]);
//        Edge::create(["from_node_id" => $sofia->id, "to_node_id" => $pleven->id, "minutes_needed"=> 5, "type_id" => 0]);


        $this->assertTrue(true);
    }
}
