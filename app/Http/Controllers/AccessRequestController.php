<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccessFormRequest;
use App\Mail\AccessRequestMail;

/**
 * Class AccessRequestController
 * @package App\Http\Controllers
 */
class AccessRequestController extends Controller
{
    public function create()
    {

    }

    public function store(AccessFormRequest $request)
    {
        \Mail::to(env('DESK_SUPPORT_EMAIL'))->send(new AccessRequestMail());

        return response()->json([
            'success' => true,
            'message' => 'Your request has been sent!',
        ]);
    }
}
