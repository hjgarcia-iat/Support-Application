<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
    public function create()
    {
        return view('contact_request.create');
    }
}
