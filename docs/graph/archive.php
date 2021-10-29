<?php

use App\Models\Edge;
use App\Models\Node;

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
//            if (!array_key_exists($fromVertex->getId(), $graph->getVertices())) {
//                $graph->add($fromVertex);
//            }
//            if (!array_key_exists($toVertex->getId(), $graph->getVertices())) {
//                $graph->add($toVertex);
//            }

    if (!array_key_exists($fromVertex->getId(), $graph->getVertices()) &&
        !array_key_exists($toVertex->getId(), $graph->getVertices())
    ) {
        $graph->add($fromVertex);
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
