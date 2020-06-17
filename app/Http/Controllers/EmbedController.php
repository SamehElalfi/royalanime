<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmbedController extends Controller
{
    public function show(Request $url) {
        $url = explode('embed/', request()->fullUrlWithQuery(["sort"=>"desc"]))[1];
        $cors = "https://cors-anywhere.herokuapp.com/";
        return view('embed.show', compact('url', 'cors'));
    }
}
