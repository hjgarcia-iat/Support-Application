<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestAQuoteForm;

/**
 * RequestQuoteController
 */
class RequestQuoteController extends Controller
{
    /**
     * Show create form
     *
     * @return void
     */
    public function create()
    {
        return view('conceptua.request_quote.create');
    }

    /**
     * Store Request
     *
     * @param RequestAQuoteForm $request
     * @return void
     */
    public function store(RequestAQuoteForm $request)
    {
        
    }
}
