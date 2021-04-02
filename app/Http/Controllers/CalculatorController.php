<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculatorRequest;
use App\Services\CrmInterface;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function show()
    {
        return view("calculator.show");
    }

    public function store(CalculatorRequest $request, CrmInterface $crm): \Illuminate\Http\JsonResponse
    {
        $crm->store($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Your message was sent!',
        ]);
    }
}
