<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\ContactRequest;

class ContactRequestMailController extends Controller
{
    public function store($id)
    {
        $contact = Contact::find($id);
    
        \Mail::to(env('DESK_SUPPORT_EMAIL'))->send(new ContactRequest($contact));

        return response()->json([
            'success' => true,
        ]);
    }
}
