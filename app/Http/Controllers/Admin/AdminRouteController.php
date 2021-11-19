<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRouteRequest;
use App\Models\Road;
use App\Models\Town;
use App\Models\RoadType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $routes = Road::with('to', 'from', 'roadType', 'fillingStations', 'fillingStations.fuels')->get();
        $towns = Town::all();

        return view('admin.routes.index', compact('routes', 'towns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $routes = Road::with('to', 'from', 'roadType', 'fillingStations', 'fillingStations.fuels')->get();
        $towns = Town::all();
        $road_types = RoadType::all();

        return view('admin.routes.create', compact('routes', 'towns', 'road_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->get('from_node_id') > $request->get('to_node_id')) {
            [$request['from_node_id'], $request['to_node_id']] = [$request['to_node_id'], $request['from_node_id']];
            session(['swapped' => true]);
        } else {
            session(['swapped' => false]);
        }

//        todo: use custom request validation
        $validated = $request->validate([
            'from_node_id' => 'required|unique_with:edges,to_node_id|not_in:'. $request['to_node_id'],
            'to_node_id' => 'required|unique_with:edges,from_node_id|not_in:' . $request['from_node_id'],
            'max_speed' => 'required|integer|between:0,500',
            'distance_in_km' => 'required|integer',
            'road_type' => 'required|integer',
        ], [
            'from_node_id.not_in' => 'Началната и крайната дестинация не могат да съвпадат.',
            'to_node_id.not_in' => 'Началната и крайната дестинация не могат да съвпадат.',
        ]);

//         todo: add max speed, type id and distance in km in view /create/
        Road::create([
            "from_node_id" => $validated['from_node_id'],
            "to_node_id" => $validated['to_node_id'],
            "distance_in_km" => $validated['distance_in_km'],
            "max_speed" => $validated['max_speed'],
            "type_id" => $validated['road_type']
        ]);

//        dd($edge, $request);
        return redirect()->route('admin.routes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $route = Road::findOrFail($id);

        return view('routes.view', compact('route'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $route = Road::where('id', '=', $id)->with([
            'to', 'from', 'roadType', 'fillingStations', 'fillingStations.fuels'
        ])->firstOrFail();

        $towns = Town::all();
        $road_types = RoadType::all();

        return view('admin.routes.edit', compact('route', 'towns', 'road_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRouteRequest $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(UpdateRouteRequest $request, int $id)
    {
//        dd($request, $id);
        Road::where('id', '=', $id)->update([
            "distance_in_km" => $request->get('distance_in_km'),
            "max_speed" => $request->get('max_speed'),
            "type_id" => $request->get('road_type'),
        ]);

        return redirect()->route('admin.routes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        Road::destroy($id);

        return redirect()->route('admin.routes.index');
    }
}
