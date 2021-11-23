<?php

namespace App\Http\Controllers;

use App\Models\Town;

class TownController extends Controller
{
    public function index()
    {
        $towns = Town::paginate(5);

        return view('towns.index', compact('towns'));
    }

    public function show($id)
    {
        $town = Town::findOrFail($id);

        return view('towns.view', compact('town'));
    }
}
