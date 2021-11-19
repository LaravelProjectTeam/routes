<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFillingStationRequest;
use App\Http\Requests\UpdateFillingStationRequest;
use App\Models\Road;
use App\Models\RoadType;
use App\Models\FillingStation;
use App\Models\Fuel;
use App\Models\Town;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
        $filling_stations = FillingStation::with('road')->paginate(5);

        return view('admin.filling_stations.index', compact('filling_stations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $roads = Road::with('to', 'from', 'roadType', 'fillingStations.fuels')->get();
        $fuels = Fuel::all();

        return view('admin.filling_stations.create', compact('roads', 'fuels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateFillingStationRequest $request
     * @return RedirectResponse
     */
    public function store(CreateFillingStationRequest $request)
    {
        $filling_station = FillingStation::create([
            'name' => $request->get('name'),
            'road_id' => $request->get('road_id'),
        ]);

        if ($request->get('fuels')) {
            $filling_station->fuels()->sync(
                $request->get('fuels')
            );
        }

        return redirect()->route('admin.filling_stations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $filling_station = FillingStation::findOrFail($id);

        return view('admin.filling_stations.view', compact('filling_station'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
//        $filling_station = FillingStation::where('id', '=', $id)->with(['road', 'road.roadType'])->get();
        $filling_station = FillingStation::findOrFail($id);
        $fuels = Fuel::all();

        return view('admin.filling_stations.edit', compact('filling_station', 'fuels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFillingStationRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateFillingStationRequest $request, int $id)
    {
        $filling_station = FillingStation::findOrFail($id);
        $filling_station->update([
            'name' => $request['name'],
        ]);

        if ($request['fuels'] ?? false) {
            $filling_station->fuels()->sync(
                $request['fuels']
            );
        }

        return redirect()->route('admin.filling_stations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        FillingStation::destroy($id);

        return redirect()->route('admin.filling_stations.index');
    }
}
