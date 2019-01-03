<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestCaseController extends Controller
{
    /**
     * Show create form
     *
     * @return void
     */
    public function create()
    {
        return view('conceptua.request_case.create');
    }
}
