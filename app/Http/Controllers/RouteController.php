<?php

namespace App\Http\Controllers;

use App\Models\Road;
use App\Models\Town;
use App\Models\User;
use App\Services\RouteService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Taniko\Dijkstra\Graph;
use UnexpectedValueException;
use function GuzzleHttp\Promise\all;

class RouteController extends Controller
{
    private $routeService;

    public function __construct(RouteService $routeService)
    {
        $this->routeService = $routeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        // eager loading data models using less queries
        $routes = Road::with('to', 'from', 'roadType', 'fillingStations', 'fillingStations.fuels')->get();
        $towns = Town::all();

        return view('routes.index', compact('routes', 'towns'));
    }

    /**
     * Display the shortest path between two towns
     *
     * @return RedirectResponse
     */
    public function search(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');

        $roads = Road::with(['from', 'to', 'roadType', 'fillingStations', 'fillingStations.fuels'])->get();
        $graph = Graph::create();

        [$message, $fullRouteInformation] = $this->routeService->getShortestPath($from, $to, $roads, $graph);

        return redirect()->route('routes.index')->with([
            'from' => $from,
            'to' => $to,
            'message' => $message,
            'fullRouteInformation' => $fullRouteInformation,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $route = Road::findOrFail($id);
        return view('routes.view', compact('route'));
    }
}
