<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Edge;
use App\Models\Node;
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
        // todo: Rename Node to Town
        $towns = Node::all();
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
     * @param Request $request
     * @return Application|Factory|View
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:nodes|max:255',
        ]);

//        todo: translate errors in bulgarian

        Node::create([
            'name' => $validated['name'],
        ]);

        $towns = Node::all();
        return view('admin.towns.index', compact('towns'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $town = Node::findOrFail($id);
        return view('admin.towns.view', compact('town'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $town = Node::findOrFail($id);
        return view('admin.towns.edit', compact('town'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        Node::where('id', $id)->update([
            'name' => $validated['name'],
        ]);

        $towns = Node::all();
        return view('admin.towns.index', compact('towns'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function destroy(int $id)
    {
        Node::destroy($id);
        $towns = Node::all();
        return view('admin.towns.index', compact('towns'));
    }
}
