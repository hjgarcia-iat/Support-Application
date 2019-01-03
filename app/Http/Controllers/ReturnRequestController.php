<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnRequestForm;
use Illuminate\Http\Request;

/**
 * Class ReturnRequestController
 * @package App\Http\Controllers
 */
class ReturnRequestController extends Controller
{
    /**
     * Show create form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('return_request.create');
    }

    public function store(ReturnRequestForm $request)
    {

    }
}
