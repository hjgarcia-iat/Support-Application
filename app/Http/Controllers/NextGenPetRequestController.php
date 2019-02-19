<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
