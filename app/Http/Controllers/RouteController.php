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

use Taniko\Dijkstra\Graph;
use UnexpectedValueException;

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

        $allEdges = Edge::all();
        $graph = Graph::create();

        foreach ($allEdges as $dbEdge) {
//            todo: calculate the minutes needed based on road, fuel, distance etc.
            $minutes_needed = $dbEdge->minutes_needed;
            $graph->add($dbEdge->from->name, $dbEdge->to->name, $minutes_needed);
        }

        $message = 'За да стигнете от ' . $from . ' до ' . $to;
        if ($from === $to) {
            $message .= ' са нужни ' . '0 минути.';
        }
        else {
            try {
                $route = $graph->search($from, $to);
                $cost  = $graph->cost($route);
                $message .= ' са нужни '. $cost . ' минути.' . PHP_EOL . 'Най-краткият маршрут е ' . join(', ', $route) . '.';
            } catch (UnexpectedValueException $e) {
//                $message = $e->getMessage();
                $message = 'Няма наличен път между ' . $from . ' и ' . $to . '.';
            }
        }

        $routes = Edge::all();
        $towns = Node::all();

        return view('routes.index', compact('routes', 'from', 'to', 'towns', 'message'));
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
