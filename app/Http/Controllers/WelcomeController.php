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
       // Display best animes
       $animes = \App\Anime::find(4)->orderBy('score', 'desc')
       ->take(4)
       ->get();

       $full_title = 'رويال أنمي - أكبر موقع أنمي على الإطلاق';

       return view('welcome', compact('animes', 'full_title'));
    }

    /**
     * Display the search page
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('dashboard.auth.login');
    }
}
