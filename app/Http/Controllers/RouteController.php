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
use function GuzzleHttp\Promise\all;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
//        $routes = Edge::all();
//        $towns = Node::all();

        // eager loading data models using less queries
        $routes = Edge::with('to', 'from', 'type')->get();
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

//       load all paths / edges with the needed data
        $allEdges = Edge::with(['from', 'to', 'type', 'fillingStations', 'fillingStations.fuels'])->get();
//        $allEdges = Edge::with(['fillingStations', 'fillingStations.fuels'])->get();

//    Бензиностация Shell предлага горивата: дизел, пропан.
//    Бензиностация Eco предлага горивата: пропан.
//    Бензиностация OMV предлага горивата: бензин, биодизел, електрически.
//    Бензиностация Petrol предлага горивата: биодизел, пропан.
//    Бензиностация Lukoil предлага горивата: бензин, дизел, пропан.

//    Бензиностация Shell предлага горивата: дизел, пропан.
//    Бензиностация Eco предлага горивата: пропан.
//    Бензиностация OMV предлага горивата: бензин, биодизел, електрически.
//    Бензиностация Petrol предлага горивата: биодизел, пропан.
//    Бензиностация Lukoil предлага горивата: бензин, дизел, пропан.

        $graph = Graph::create();
        $fullRouteInformation = null;
        $allStationsOnAllEdges = [];

        // only do this when needed
        if ($from !== $to) {
            // go over all the edges in the database
            foreach ($allEdges as $edge) {
                // get all filling stations and cycle them
                foreach ($edge->fillingStations as $fillingStation) {
                    $fillingStationName = $fillingStation->name;
                    $fillingStationFuels = [];

                    $fuels = $fillingStation->fuels;

                    foreach ($fuels as $fuel) {
                        $fillingStationFuels[] = $fuel->name;
                    }

                    $fillingStationInfo =
                        "Бензиностация " . $fillingStationName .
                        " (между " . $edge->from->name . " и " . $edge->to->name . ")" . " предлага горивата: " .
                        join(', ', $fillingStationFuels) . ".";

//                echo "<br>1 >> <br>".  $fillingStationInfo . " | " . $edge->from->name . " => ". $edge->to->name . " | <br><br>" ;
                    $key = ($edge->from->name . $edge->to->name);
//                echo $key . '<br><br>';
//                     todo: check the following concern
//                     this may be a problem with multiple filling stations on this edge
                    $allStationsOnAllEdges[$key] = $fillingStationInfo;
                }

//            $allFillingStationsOnAnEdgeInfo = join(PHP_EOL, $allStationsOnAllEdges ?? []);
//            echo "<br><br>2 >> <br>" . $allFillingStationsOnAnEdgeInfo . "<br>";

//            dd($allStationsOnAllEdges);
//            var_dump($allStationsOnAllEdges);
                $graph->add($edge->from->name, $edge->to->name, $edge->minutes_needed, true, null);
            }
        }

//        dd($allStationsOnAllEdges);
        $message = 'За да стигнете от ' . $from . ' до ' . $to;
        if ($from === $to) {
            $message .= ' са нужни ' . '0 минути.';
        }
        else {
            try {
                // get the shortest path from and to
                $route = $graph->search($from, $to);

                // generate valid paths in the formats:
                // fromto
                // tofrom
                $validPaths = [];
                for ($index = 0; $index < count($route) - 1; $index++) {
                    $pathBothWays1 = $route[$index] .  $route[$index + 1];
                    $validPaths[] = $pathBothWays1;
                }

                for ($idx = count($route) - 2; $idx >= 0; $idx--) {
                    $pathBothWays2 = $route[$idx + 1] .  $route[$idx];
                    $validPaths[] = $pathBothWays2;
                }

                // transform to the format
                // [ "fromto" => "fromto", "tofrom" => "tofrom" ]
                $paths = [];
                foreach($validPaths as $validPath){
                    $paths[$validPath] = $validPath;
                }

                $fullRouteInformation = array_intersect_key($allStationsOnAllEdges,$paths);
//                dd(array_fill_keys($validPaths,1), $route, $allStationsOnAllEdges);
//                dd($paths,$route,$allStationsOnAllEdges,array_intersect_key($allStationsOnAllEdges,$paths));

                $cost = $graph->cost($route);
//                $data = $graph->getPathData($route);
//                dd($data, $fullRouteInformation);
//                echo "<pre>" . join(PHP_EOL, $data)  . "</pre>";
//                echo '<pre>' . var_dump($data) . '</pre>;
                $message .= ' са нужни '. $cost . ' минути.' . PHP_EOL . 'Най-краткият маршрут е ' . join(', ', $route) . '.'
//                    . " " . join(" ", $data)
                ;
            } catch (UnexpectedValueException $e) {
//                $message = $e->getMessage();
                $message = 'Няма наличен път между ' . $from . ' и ' . $to . '.';
            }
        }

        $routes = Edge::with('to', 'from', 'type')->get();
        $towns = Node::all();

//        return redirect('routes.index')->with(compact('routes', 'from', 'to', 'towns', 'message', 'fullRouteInformation'));
        return view('routes.index', compact('routes', 'from', 'to', 'towns', 'message', 'fullRouteInformation'));
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
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
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