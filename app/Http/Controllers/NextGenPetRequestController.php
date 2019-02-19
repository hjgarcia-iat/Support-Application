<?php

namespace App\Http\Controllers;

use App\Http\Requests\NextGenPetRequest;
use App\Mail\NextGenPetRequestMail;

/**
 * Class NextGenPetRequestController
 * @package App\Http\Controllers
 */
class NextGenPetRequestController extends Controller
{
    /**
     * Show create form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('nextgen_pet_request.create');
    }

    /**
     * Store the next gen pet request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NextGenPetRequest $request)
    {
        \Mail::to([env('DESK_SUPPORT_EMAIL'),env('FULFILLMENT_EMAIL')])
            ->send(new NextGenPetRequestMail());

        return response()->json([
            'success' => true,
            'message' => 'Your message was sent!',
        ]);
    }
}
