<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactRequest;

class ContactRequestController extends Controller
{
    public function create()
    {
        return view('contact_request.create');
    }

    public function store(ContactFormRequest $request)
    {
        \Mail::to(env('DESK_SUPPORT_EMAIL'))->send(new ContactRequest());

        return response()->json([
            'success' => true,
            'message' => 'Your request has been sent!',
        ]);
    }
}
