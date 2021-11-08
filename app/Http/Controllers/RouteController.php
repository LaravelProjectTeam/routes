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
    function sampling($chars, $size, $combinations = array())
    {
        # if it's the first iteration, the first set
        # of combinations is the same as the set of characters
        if (empty($combinations)) {
            $combinations = $chars;
        }

        # we're done if we're at size 1
        if ($size == 1) {
            return $combinations;
        }

        # initialise array to put new values in
        $new_combinations = array();

        # loop through existing combinations and character set to create strings
        foreach ($combinations as $combination) {
            foreach ($chars as $char) {
                $new_combinations[] = $combination . $char;
            }
        }

        # call same function again for the next iteration
        return $this->sampling($chars, $size - 1, $new_combinations);
    }

//// example
//$chars = array('a', 'b', 'c');
//$output = sampling($chars, 2);

// $chars = array('a', 'b', 'c');
// $output = sampling($chars, 2);
//var_dump($output);
    /*
    array(9) {
      [0]=>
      string(2) "aa"
      [1]=>
      string(2) "ab"
      [2]=>
      string(2) "ac"
      [3]=>
      string(2) "ba"
      [4]=>
      string(2) "bb"
      [5]=>
      string(2) "bc"
      [6]=>
      string(2) "ca"
      [7]=>
      string(2) "cb"
      [8]=>
      string(2) "cc"
    }
    */

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

//       load all paths / edges with the needed data
        $allEdges = Edge::with(['fillingStations', 'fillingStations.fuels'])->get();

//    Бензиностация Shell предлага горивата: дизел, пропан.
//    Бензиностация Eco предлага горивата: пропан.
//    Бензиностация OMV предлага горивата: бензин, биодизел, електрически.
//    Бензиностация Petrol предлага горивата: биодизел, пропан.
//    Бензиностация Lukoil предлага горивата: бензин, дизел, пропан.

        // create the graph, used for finding the shortest path later


//        [3] => Бензиностация Shell предлага горивата: дизел, пропан.
//    Бензиностация Eco предлага горивата: пропан.
//    Бензиностация OMV предлага горивата: бензин, биодизел, електрически.
//    Бензиностация Petrol предлага горивата: биодизел, пропан.
//    Бензиностация Lukoil предлага горивата: бензин, дизел, пропан.

        $graph = Graph::create();
        $fullRouteInformation = null;
        $allStationsOnAllEdges = [];

        if ($from !== $to) {
            // go over all the edges in the database
            foreach ($allEdges as $edge) {
                // get all filling stations and cycle them
                foreach ($edge->fillingStations as $fillingStation) {
                    $fillingStationName = $fillingStation->name;
                    $fillingStationFuels = [];

                    $fuels = $fillingStation->fuels;

                    foreach ($fuels as $fuel) {
                        $fillingStationFuels[] =  $fuel->name;
                    }

                    $fillingStationInfo =
                        "Бензиностация " . $fillingStationName .
                        " (между " . $edge->from->name . " и " . $edge->to->name . ")" . " предлага горивата: " .
                        join(', ', $fillingStationFuels) . ".";

//                echo "<br>1 >> <br>".  $fillingStationInfo . " | " . $edge->from->name . " => ". $edge->to->name . " | <br><br>" ;
                    $key = ($edge->from->name . $edge->to->name);
//                echo $key . '<br><br>';
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

                // generate possible paths in the formats:
                // fromto
                // tofrom
                $possibleValidPaths = [];
                for ($index = 0; $index < count($route) - 1; $index++) {
                    $pathBothWays1 = $route[$index] .  $route[$index + 1];
                    $possibleValidPaths[] = $pathBothWays1;
                }

                for ($idx = count($route) - 2; $idx >= 0; $idx--) {
                    $pathBothWays2 = $route[$idx + 1] .  $route[$idx];
                    $possibleValidPaths[] = $pathBothWays2;
                }

                // transform to the format
                // [ "fromto" => "fromto", "tofrom" => "tofrom" ]
                $paths = [];
                foreach($possibleValidPaths as $val){
                    $paths[$val] = $val;
                }

                $fullRouteInformation = array_intersect_key($allStationsOnAllEdges,$paths);
//                dd(array_fill_keys($possibleValidPaths,1), $route, $allStationsOnAllEdges);
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

        $routes = Edge::all();
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
