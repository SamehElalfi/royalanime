<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;

class StatusController extends Controller
{
    public function __construct()
    {
        // Cache the final page  as html file in /public/page-cache/
        $this->middleware('page-cache', ['only' => ['index', 'show']]);
    }
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
    public function show($id, Request $request)
    {
        // Ordering and sorting options
        $sortBy = $request->input('sortBy');
        $order = $request->input('order');

        if (!in_array($order, ['DESC', 'ASC'])) {
            $order = 'ASC';
        }

        if (!in_array($sortBy, ['title', 'score', 'date'])) {
            $sortBy = 'title';
        }

        // $sortBy = $sortBy == 'date' ?  : $sortBy;

        if ($sortBy == 'date') {
            // return $id;
            // Display anime list
            $paginator = Anime::orderBy('aired_from', $order)->where('status', 'like', '%' . $id . '%')->paginate(10);
            $paginator = $paginator->appends(['sortBy' => 'date', 'order' => $order]);
        } else {
            // Display anime list
            $paginator = Anime::orderBy($sortBy, $order)->where('status', 'like', '%' . $id . '%')->paginate(10);
            $paginator = $paginator->appends(['sortBy' => $sortBy, 'order' => $order]);
        }

        // Return 404 error if there are no animes
        if ($paginator == null) {
            abort(404);
        }

        $primary_nav = true;
        $title = 'أنمي ' . $id;
        $description = 'كل الأنميات ' . $id;
        // $tag = $id;
        return view('tag.show', compact('paginator', 'primary_nav', 'title', 'description', 'id', 'sortBy', 'order'));
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
