<?php

namespace App\Http\Controllers;

/**
 * Class RequestDemoController
 * @package App\Http\Controllers
 */
class RequestDemoController extends Controller
{
    /**
     * Show create form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('conceptua.request_demo.create');
    }
}
