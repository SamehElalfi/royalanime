<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display the home page of the website.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
        return cdsdn('/css/app.css');
        // Display best animes
        $animes = \App\Anime::find(4)->orderBy('score', 'desc')
        ->take(4)
        ->get();
        // dd($animes);
        return view('welcome', compact('animes'));
     }
}
