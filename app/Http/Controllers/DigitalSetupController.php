<?php

namespace App\Http\Controllers;

use App\Http\Requests\DigitalSetupRequestForm;
use App\Mail\DigitalSetupRequestMail;
use Illuminate\Http\Request;

class DigitalSetupController extends Controller
{
    public function create()
    {
        return view('digital_setup_request.create');
    }

    public function store(DigitalSetupRequestForm $request)
    {
        \Mail::to(config('mail.to.support_email'))->send(new DigitalSetupRequestMail());

        return response()->json([
            'success' => true,
            'message' => 'Your message was sent!',
        ]);
    }
}
