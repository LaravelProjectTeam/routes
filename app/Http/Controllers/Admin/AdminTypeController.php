<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\RoadType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $types = RoadType::all();

        return view('admin.road_types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.road_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTypeRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTypeRequest $request)
    {
        RoadType::create([
            'name' => $request->get('type_name'),
            'hardship_level' => $request->get('hardship'),
        ]);

        return redirect()->route('admin.road_types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param RoadType $type
     * @return Response
     */
    public function show(RoadType $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $road_type = RoadType::findOrFail($id);

        return view('admin.road_types.edit', compact('road_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTypeRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdateTypeRequest $request, $id)
    {
        RoadType::findOrFail($id)->update([
            'name' => $request->get('type_name'),
            'hardship_level' => $request->get('hardship')
        ]);

        return redirect()->route('admin.road_types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        RoadType::destroy($id);

        return redirect()->route('admin.road_types.index');
    }
}
