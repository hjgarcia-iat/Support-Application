<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemoteLearningRequest;
use App\Mail\RemoteLearningRequestMail;

class RemoteLearningRequestController extends Controller
{
    public function create()
    {
        return view('remote_learning_request.create');
    }

    public function store(RemoteLearningRequest $request)
    {
        \Mail::to(env('REMOTE_SETUP_REQUEST'))->send(new RemoteLearningRequestMail());

        return response()->json([
            'success' => true,
            'message' => 'Your message was sent!',
        ]);
    }
}
