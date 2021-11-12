<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Edge;
use App\Models\FillingStation;
use App\Models\Fuel;
use App\Models\Node;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminFillingStationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        // todo: Rename Node to Town
        $filling_stations = FillingStation::all();
        return view('admin.filling_stations.index', compact('filling_stations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $direct_routes = Edge::with('to', 'from', 'type', 'fillingStations.fuels')->get();
        $fuels = Fuel::all();
        return view('admin.filling_stations.create', compact('direct_routes', 'fuels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function store(Request $request)
    {
//        dd($request->fuels);

        // todo: check shortest path algo when fuels null
        $validated = $request->validate([
            'name' => 'required|unique:nodes|max:255',
            'edge_id' => 'required|numeric',
//            'fuels' => 'required?'
        ]);

        $filling_station = FillingStation::create([
            'name' => $validated['name'],
            'edge_id' => $validated['edge_id'],
        ]);

        if (!empty($validated['fuels'])) {
            foreach ($validated['fuels'] as $fuel) {
                $filling_station->fuels->attach([
                    $fuel->id,
                ]);
            }
        }

        $filling_stations = FillingStation::all();
        return view('admin.filling_stations.index', compact('filling_stations'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $filling_station = FillingStation::findOrFail($id);
        return view('admin.filling_stations.view', compact('filling_station'));
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
     * @return Application|Factory|View
     */
    public function destroy($id)
    {
        FillingStation::destroy($id);
        $filling_stations = FillingStation::all();
        return view('admin.filling_stations.index', compact('filling_stations'));
    }
}
