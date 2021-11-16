<?php

namespace App\Http\Controllers;

use App\Models\Node;

class TownController extends Controller
{
    public function index()
    {
        // todo: Rename Node to Town
        $towns = Node::all();

        return view('towns.index', compact('towns'));
    }

    public function show($id)
    {
        $town = Node::findOrFail($id);

        return view('towns.view', compact('town'));
    }
}
