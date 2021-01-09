<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;

class IndexController extends Controller
{
    /**
     * Display the home page of the website.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: Add latest episodes in the home page

        // Display best animes
        $animes = Anime::find(4)->orderBy('score', 'desc')
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
