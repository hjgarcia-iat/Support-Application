<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactFormRequest;

class ContactRequestController extends Controller
{
    public function create()
    {
        return view('contact_request.create');
    }

    public function store(ContactFormRequest $request)
    {

        //save to the database
        $contact = Contact::create([
            'reason'   => $request->get('reason'),
            'name'     => $request->get('name'),
            'email'    => $request->get('email'),
            'district' => $request->get('district'),
            'subject'  => $request->get('subject'),
            'details'  => $request->get('details'),
        ]);

        // \Mail::to(env('DESK_SUPPORT_EMAIL'))->send(new ContactRequest($contact));

        return response()->json([
            'success' => true,
            'id' => $contact->id,
        ]);
    }
}
