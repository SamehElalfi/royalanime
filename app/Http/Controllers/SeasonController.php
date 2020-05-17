<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function __construct() {
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
        // dd(Analytics::fetchVisitorsAndPageViews(Period::days(7)));
        $primary_nav = true;
        $title = 'كل مواسم الأنمي';
        $description = 'كل مواسم الأنمي من موقع رويال أنمي';
        $seasons = \App\Anime::whereNotNull('premiered')->groupBy('premiered')->pluck('premiered')->reverse();
        // return $seasons;
        return view('season.index', compact('primary_nav', 'title', 'description', 'seasons'));
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
            // Display anime list
            $paginator = \App\Anime::orderBy('aired_from', $order)->where('premiered','like', '%'.$id.'%')->paginate(10);
            $paginator = $paginator->appends(['sortBy'=> 'date', 'order'=>$order]);
        } else {
            // Display anime list

            $paginator = \App\Anime::orderBy($sortBy, $order)->where('premiered','like', '%'.$id.'%')->paginate(10);
            $paginator = $paginator->appends(['sortBy'=> $sortBy, 'order'=>$order]);
        }
        // Return 404 error if there are no animes
        if ($paginator == null){abort(404);}
        
        $primary_nav = true;
        $title = 'موسم '. $id;
        $description = 'كل أنميات ' .$id;
        return view('season.show', compact('paginator', 'primary_nav', 'title', 'description', 'id', 'sortBy', 'order'));
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
