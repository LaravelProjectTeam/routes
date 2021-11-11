<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class AdminTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.road_types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.road_types.create');
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
    //         'hardship' => ['required', 'integer|min:0|max:10', 'unique:road_types'],
    //     ]);
    // }

    public function store(Request $request)
    {
        $type = new Type;

//        $this->validate($request, [
//            'type_name' => 'required|string',
//            'hardship_level' => 'required|integer'
//        ]);

        $type->create(['name' => $request->type_name, 'hardship_level' => $request->hardship]);
        return redirect()->route('admin.road_types.index');

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
    public function edit(int $id)
    {
        $type = Type::findOrFail($id);
        return view('admin.road_types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = Type::findOrFail($id);
        $type->name=$request->type_name;
        $type->hardship_level=$request->hardship;
        $type->save();

        return redirect()->route('admin.road_types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Type::destroy($id);
        return redirect()->route('admin.road_types.index');
    }
}
