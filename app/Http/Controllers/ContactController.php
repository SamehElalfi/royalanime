<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
// use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;
use App\Models\User;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'تواصل معنا';
        return view('legal.contact', compact('title'));
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
        $validatedData = $request->validate([
            'email' => 'required|max:255|email',
            'name' => 'required|min:2|max:255',
            'previous_url' => 'url',
            'message' => 'required',
        ]);

        $msg = new Contact;
        $msg->name = $validatedData['name'];
        $msg->email = $validatedData['email'];
        $msg->previous_url = $validatedData['previous_url'];
        $msg->message = $validatedData['message'];
        $msg->save();
        \Slack::to('#welcome')->send('A new message created succesfully by ' . $validatedData['name']);
        // $s = new SlackMessage;
        // $s->success()->content('One of your invoices has been paid!');
        // Notification::send(User::first(), new ContactMessageCompleted());

        $title = 'تم إرسال الرسالة بنجاح';
        return view('/legal/thanks', compact('title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(contact $contact)
    {
        //
    }
}
