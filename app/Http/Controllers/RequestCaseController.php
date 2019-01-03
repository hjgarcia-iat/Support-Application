<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ConceptuaMathCaseStudyRequest;

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

    /**
     * Show create form
     *
     * @return void
     */
    public function store(ConceptuaMathCaseStudyRequest $request)
    {
        
    }
}
