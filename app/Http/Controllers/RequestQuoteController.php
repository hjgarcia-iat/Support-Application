<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CRMInterface;
use App\Mail\ConceptuaQuoteRequestMail;
use App\Http\Requests\RequestAQuoteForm;

/**
 * RequestQuoteController
 */
class RequestQuoteController extends Controller
{

    /**
     * @var CRMInterface
     */
    private $crm;

    public function __construct(CRMInterface $crm)
    {
        $this->crm = $crm;
    }

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
        $this->crm->createConceptuaQuoteRequestLead($request);

        \Mail::to($request->get('email'))->send(new ConceptuaQuoteRequestMail($request));

        return response()->json([
            'success' => true,
            'message' => 'Your message was sent.'
        ]);
    }
}
