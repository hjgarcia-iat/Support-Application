<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactFormRequest;

class SupportTicketController extends Controller
{
    public function create()
    {
        return view('support_ticket.create');
    }

    public function store(ContactFormRequest $request): \Illuminate\Http\JsonResponse
    {
        $contact = Contact::create([
            'reason'   => $request->get('reason'),
            'name'     => $request->get('name'),
            'email'    => $request->get('email'),
            'district' => $request->get('district'),
            'subject'  => $request->get('subject'),
            'details'  => $request->get('details'),
        ]);

        return response()->json([
            'success' => true,
            'id' => $contact->id,
        ]);
    }
}
