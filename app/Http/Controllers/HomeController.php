<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function index ()
    {
//        echo __('bg.Routes');
//        $response = new Response('Set Cookie');
//        $response->withCookie(cookie('lang', 'es', 13));
        return view('home.index');
    }
}
