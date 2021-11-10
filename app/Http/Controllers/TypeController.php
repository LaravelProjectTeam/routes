<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view('roads.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'hardship' => ['required', 'integer|min:0|max:10', 'unique:types'],
    //     ]);
    // }

    public function store(Request $request)
    {
        $type = new Type;
        $type->create(['name' => $request->type_name, 'hardship_level' => $request->hardship]);
        return redirect()->route('types.index');

        $this->validate($request, [
        'type_name' => 'required|string',
        'hardship' => 'required|integer'
    ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('roads.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $type->name=$request->type_name;
        $type->hardship_level=$request->hardship;
        $type->save();
        return redirect()->route('types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('types.index');
    }
}
