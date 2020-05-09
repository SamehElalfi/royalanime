<?php

namespace App\Http\Controllers;

use App\Anime;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    public function __construct() {
        // Cache the final page  as html file in /public/page-cache/
        $this->middleware('page-cache', ['only' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Display anime list
        $paginator = Anime::orderBy('title')->paginate(10);

        // Return 404 error if there are no animes
        if ($paginator == null){abort(404);}
        
        $primary_nav = true;
        $title = 'قائمة الأنمي';
        $description = 'أكبر قائمة للأنمي على الأطلاق مقدمة حصريًأ من موقع رويال أنمي';
        return view('anime.index', compact('paginator', 'primary_nav', 'title', 'description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return 'hi';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function show(anime $anime)
    {
        // the meta tag of anime page
        $title = "مشاهدة وتحميل " . $anime->title;
        $description = $anime->background;

        // anime variable is passd to this function
        return view('anime.show', compact('anime', 'title', 'description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function edit(anime $anime)
    {
        return 'edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, anime $anime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\anime  $anime
     * @return \Illuminate\Http\Response
     */
    public function destroy(anime $anime)
    {
        //
    }
}
