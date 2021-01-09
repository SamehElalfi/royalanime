<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
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
        return view('subscriber.index');
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
        // return $request;
        $validatedData = $request->validate([
            'email' => 'required|max:255|email',
            'previous_url' => 'url',
            'current_url' => 'url',
        ]);

        $subscriber = new Subscriber;
        $subscriber->email = $validatedData['email'];
        $previous_url = '/';
        if (isset($validatedData['previous_url'])) {
            $subscriber->previous_url = $validatedData['previous_url'];
            $previous_url = $subscriber->previous_url;
        }
        if (isset($validatedData['current_url'])) {
            $subscriber->current_url = $validatedData['current_url'];
        }
        $subscriber->save();

        return view('subscriber.thanks', compact('previous_url'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show(subscriber $subscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(subscriber $subscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, subscriber $subscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(subscriber $subscriber)
    {
        //
    }
}
