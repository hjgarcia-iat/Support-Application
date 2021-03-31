<?php

namespace App\Http\Controllers;

use App\Services\CRMInterface;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function show()
    {
        return view("calculator.show");
    }

    public function store(Request $request, CRMInterface $crm): \Illuminate\Http\JsonResponse
    {
        $crm->store();

        return response()->json([
            'success' => true,
            'message' => 'Your message was sent!',
        ]);
    }
}
