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
    /**
     * Show the access request form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('access_request.create');
    }

    /**
     * Store the access request form
     *
     * @param AccessFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AccessFormRequest $request)
    {
        \Mail::to(env('DESK_SUPPORT_EMAIL'))->send(new AccessRequestMail());

        return response()->json([
            'success' => true,
            'message' => 'Your request has been sent!',
        ]);
    }
}
