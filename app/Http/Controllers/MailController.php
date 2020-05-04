<?php

namespace App\Http\Controllers;

use App\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
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
        return view('mail.index');
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

        $mail = new Mail;
        $mail->email = $validatedData['email'];
        $previous_url = '/';
        if (isset($validatedData['previous_url'])) {
            $mail->previous_url = $validatedData['previous_url'];
            $previous_url = $mail->previous_url;
        }
        if (isset($validatedData['current_url'])) {
            $mail->current_url = $validatedData['current_url'];
        }
        $mail->save();
        
        return view('mail.thanks', compact('previous_url'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function show(mail $mail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function edit(mail $mail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mail $mail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function destroy(mail $mail)
    {
        //
    }
}
