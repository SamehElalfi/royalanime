<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmbedController extends Controller
{
    public function show(Request $url) {
        $url_parts = explode('royalembed/', request()->fullUrl());
        $url = join('/', array_slice($url_parts, 1));
        $cors = "https://cors-anywhere.herokuapp.com/";

        // return $url;

        // TODO: Split javascript functions and don't pass them 
        // unless it's necessary for the URL Video
        return view('embed.show', compact('url', 'cors'));
    }
}
