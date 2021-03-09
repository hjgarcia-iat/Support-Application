<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactRequest;
use Storage;

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

        if($request->hasFile('file')) {
            //upload file
            Storage::disk('s3')->putFile('contact-request', $request->file('file'));
            $filename = $request->file('file')->hashName();
            $contact->file = $filename;
            $contact->save();
        }

        //mail to support
        \Mail::to(env('DESK_SUPPORT_EMAIL'))->send(new ContactRequest($contact));

        return response()->json([
            'success' => true,
            'message' => 'Your request has been sent!',
        ]);
    }
}
