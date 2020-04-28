<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $primary_nav = true;
        $title = 'كل تصنيفات الأنمي';
        $description = 'كل تصنيفات الأنمي من موقع رويال أنمي';
        return view('tag.index', compact('primary_nav', 'title', 'description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;
        // Display anime list
        $paginator = \App\Anime::orderBy('title')->where('genres','like', '%'.$id.'%')->paginate(10);

        // Return 404 error if there are no animes
        if ($paginator == null){abort(404);}
        
        $primary_nav = true;
        $title = 'تصنيف '. $id;
        $description = 'كل الأنميات ذات التصنيف  ' .$id;
        // $tag = $id;
        return view('tag.show', compact('paginator', 'primary_nav', 'title', 'description', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
