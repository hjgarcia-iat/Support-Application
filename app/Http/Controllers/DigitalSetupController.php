<?php

namespace App\Http\Controllers;

use App\Http\Requests\DigitalSetupRequestForm;
use Illuminate\Http\Request;

/**
 * Class DigitalSetupController
 * @package App\Http\Controllers
 */
class DigitalSetupController extends Controller
{
    /**
     * Show create form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('digital_setup_request.create');
    }


    public function store(DigitalSetupRequestForm $request)
    {

    }
}
