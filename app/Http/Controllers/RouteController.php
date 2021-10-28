<?php

namespace App\Http\Controllers;

use App\Models\Edge;
use App\Models\Node;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Doctrine;
use Doctrine\OrientDB\Graph\Vertex;
use Doctrine\OrientDB\Graph\Graph;
use Doctrine\OrientDB\Graph\Algorithm\Dijkstra;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        // todo: optimize
        $routes = Edge::all();
        $towns = Node::all();

        return view('routes.index', compact('routes', 'towns'));
    }

    /**
     * Display the shortest path between two towns
     *
     * @return Application|Factory|View
     */
    public function search(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');

//        $fromNode = Node::where('name', $from)->get();
//        $toNode = Node::where('name', $to)->get();

        $graph = new Graph();
        $allEdges = Edge::all();
        $startingVertex = null;
        $endingVertex = null;

        foreach ($allEdges as $databaseEdge) {
            $fromVertex = new Vertex($databaseEdge->from->name);
            $toVertex = new Vertex($databaseEdge->to->name);

//            todo: calculate the minutes needed based on road, fuel, distance etc
            $minutes_needed = $databaseEdge->minutes_needed;
//            dd($fromVertex, $toVertex ,$minutes_needed);

            // connect vertices both ways
            $fromVertex->connect($toVertex, $minutes_needed);
            $toVertex->connect($fromVertex, $minutes_needed);

            // only add unique vertices
            if (!array_key_exists($fromVertex->getId(), $graph->getVertices())) {
                $graph->add($fromVertex);
            }

            if (!array_key_exists($toVertex->getId(), $graph->getVertices())) {
                $graph->add($toVertex);
            }

//            echo $edge->from->name;
//            echo $from;
//            echo $edge->to->name;
//            echo $to;

//            echo ($databaseEdge->from->name .' '. $from .' '. $databaseEdge->to->name .' '. $to);
//            echo "<br>";
//            echo $databaseEdge->to->name . ' ' . $from;

            foreach ($graph->getVertices() as $vertex) {
                if ($databaseEdge->from->name === $from || $databaseEdge->to->name === $from ) {
                    if ($vertex->getId() === $from) {
                        $startingVertex = $vertex;
                    }
                }

                if ($databaseEdge->from->name === $to || $databaseEdge->to->name === $to) {
                    if ($vertex->getId() === $to) {
                        $endingVertex = $vertex;
                    }
                }
            }

//            dd($edge->from->name, $edge->to->name, $graph);
        }

//        dd($graph);
//        dd($startingVertex, $endingVertex);
        // todo: should all the towns should be connected by a road or there could be ones which are not?
        // todo: check case for when has selected non connected town [should it be possible or not by specifications?]
        if (!$startingVertex || !$endingVertex) {
            echo "Градовете не са свързани.";
            return null;
        }

        $algorithm = new Dijkstra($graph);
        $algorithm->setStartingVertex($startingVertex);
        $algorithm->setEndingVertex($endingVertex);

//        echo "<pre>"; var_dump($graph); echo "</pre>";
//        dd($algorithm);
//        $sol = $algorithm->solve();
//        dd($sol);

        $result = '';
        if ($startingVertex === $endingVertex) {
            $result .= $algorithm->getLiteralShortestPath() . " [нужни минути " . 0 . "]";
        } else {
            $result .= $algorithm->getLiteralShortestPath() . " [нужни минути " . $algorithm->getDistance() . "]";
        }
//        var_dump($algorithm->getDistance());
//        dd($fromNode, $toNode);


        // todo: optimize
        $routes = Edge::all();
        $towns = Node::all();

        return view('routes.search', compact( 'result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        // todo: improve
        $route = Edge::findOrFail($id);
        return view('routes.view', compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
