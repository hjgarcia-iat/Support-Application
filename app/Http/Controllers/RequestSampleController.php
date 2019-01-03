<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * RequestSampleController
 */
class RequestSampleController extends Controller
{
    public function create()
    {
        return view('conceptua.request_sample.create');
    }
}
