<?php

namespace App\Http\Controllers;

use \App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke($page)
    {
        // $fulltitle = $page;
        $primary_nav = true;

        $title = __('pages.' . $page);

        $description = 'أكبر قائمة للأنمي على الأطلاق مقدمة حصريًأ من موقع رويال أنمي';
        return view('pages.' . $page, compact('title', 'description', 'primary_nav'));
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
     * @param  \\App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \\App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \\App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \\App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(page $page)
    {
        //
    }
}
