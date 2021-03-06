<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fuel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFuelRequest;
use App\Http\Requests\UpdateFuelRequest;
use Illuminate\Http\Response;

class AdminFuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $fuels = Fuel::all();

        return view('admin.fuels.index', compact('fuels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.fuels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFuelRequest $request
     * @return RedirectResponse
     */
    public function store(StoreFuelRequest $request)
    {
        Fuel::create([
            'name' => $request->get('fuel_name')
        ]);

        return redirect()->route('admin.fuels.index');
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param Fuel $fuel
//     * @return Response
//     */
//    public function show(Fuel $fuel)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Fuel $fuel
     * @return Application|Factory|View
     */
    public function edit(Fuel $fuel)
    {
        return view('admin.fuels.edit',compact('fuel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFuelRequest $request
     * @param Fuel $fuel
     * @return RedirectResponse
     */
    public function update(UpdateFuelRequest $request, Fuel $fuel)
    {
        $fuel->update([
            'name' => $request->get('fuel_name'),
        ]);

        return redirect()->route('admin.fuels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Fuel $fuel
     * @return RedirectResponse
     */
    public function destroy(Fuel $fuel)
    {
        $fuel->delete();

        return redirect()->route('admin.fuels.index');
    }
}
