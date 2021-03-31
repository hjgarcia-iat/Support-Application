<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemoteSupportRequest;
use App\Mail\NextGenPetRequestMail;
use App\Mail\RemoteSupportRequestMail;
use Illuminate\Http\Request;

class RemoteSupportRequestController extends Controller
{
    public function create()
    {
        return view('remote_support.create');
    }

    public function store(RemoteSupportRequest $request)
    {
        \Mail::to([env('DESK_SUPPORT_EMAIL')])
            ->send(new RemoteSupportRequestMail($request));

        return response()->json([
            'success' => true,
            'message' => 'Your message was sent!',
        ]);
    }
}
