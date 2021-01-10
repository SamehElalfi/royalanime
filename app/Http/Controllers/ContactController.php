<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Models\User;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:super admin|admin'], ['only' => ['index', 'destroy', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO Create a page to show all messages
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'تواصل معنا';
        return view('contact.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $msg = Contact::create([
            "name" => $request->get('name'),
            "email" => $request->get('email'),
            "previous_url" => $request->get('previous_url'),
            "message" => $request->get('message'),
        ]);

        $title = 'تم إرسال الرسالة بنجاح';
        return view('contact.thanks', compact('title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(contact $contact)
    {
        // TODO Create Show page
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(contact $contact)
    {
        return $contact->delete();
    }
}
