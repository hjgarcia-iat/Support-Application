<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestProductInformationRequest;
use App\Services\CrmInterface;

class RequestProductInformationController extends Controller
{
    public function create()
    {
        return view('request_product_info.create');
    }

    public function store(CrmInterface $crm, RequestProductInformationRequest $request): \Illuminate\Http\JsonResponse
    {
        $crm->store($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Your message was sent!',
        ]);
    }
}