<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\ContactRequest;

class ContactRequestMailController extends Controller
{
    public function store($id): \Illuminate\Http\JsonResponse
    {
        \Mail::to(env('DESK_SUPPORT_EMAIL'))->send(new ContactRequest($id));

        return response()->json([
            'success' => true,
        ]);
    }
}
