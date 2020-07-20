<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentSupportRequestController extends Controller
{
    public function create()
    {
        return view('student_request.create');
    }
}
