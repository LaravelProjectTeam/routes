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
        if ($request->get('from_town_id') > $request->get('to_town_id')) {
            [$request['from_town_id'], $request['to_town_id']] = [$request['to_town_id'], $request['from_town_id']];
            session(['swapped' => true]);
        } else {
            session(['swapped' => false]);
        }

        $validated = $request->validate([
            'from_town_id' => 'required|unique_with:roads,to_town_id|not_in:'. $request['to_town_id'],
            'to_town_id' => 'required|unique_with:roads,from_town_id|not_in:' . $request['from_town_id'],
            'max_speed_in_km_per_hour' => 'required|integer|between:0,500',
            'distance_in_km' => 'required|integer',
            'road_type' => 'required|integer',
        ], [
            'from_town_id.not_in' => 'Началната и крайната дестинация не могат да съвпадат.',
            'to_town_id.not_in' => 'Началната и крайната дестинация не могат да съвпадат.',
        ]);

        Road::create([
            "from_town_id" => $validated['from_town_id'],
            "to_town_id" => $validated['to_town_id'],
            "distance_in_km" => $validated['distance_in_km'],
            "max_speed_in_km_per_hour" => $validated['max_speed_in_km_per_hour'],
            "road_type_id" => $validated['road_type']
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
        Road::where('id', '=', $id)->update([
            "distance_in_km" => $request->get('distance_in_km'),
            "max_speed_in_km_per_hour" => $request->get('max_speed_in_km_per_hour'),
            "road_type_id" => $request->get('road_type_id'),
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
