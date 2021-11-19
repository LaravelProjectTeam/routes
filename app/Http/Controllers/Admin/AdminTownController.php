<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTownRequest;
use App\Http\Requests\UpdateTownRequest;
use App\Models\Road;
use App\Models\Town;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AdminTownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        // todo: Rename Town to Town

        $towns = Town::paginate(5);

        return view('admin.towns.index', compact('towns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.towns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTownRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTownRequest $request)
    {
        Town::create([
            'name' => $request->get('name'),
        ]);

        return redirect()->route('admin.towns.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $town = Town::findOrFail($id);

        return view('admin.towns.view', compact('town'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $town = Town::findOrFail($id);

        return view('admin.towns.edit', compact('town'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTownRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateTownRequest $request, int $id)
    {
        Town::where('id', $id)->update([
            'name' => $request->get('name'),
        ]);

        return redirect()->route('admin.towns.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        Town::destroy($id);

        return redirect()->route('admin.towns.index');
    }
}
