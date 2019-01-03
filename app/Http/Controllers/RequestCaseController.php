<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CRMInterface;
use App\Mail\ConceptuaCaseStudyMail;
use App\Http\Requests\ConceptuaMathCaseStudyRequest;

class RequestCaseController extends Controller
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
        return view('conceptua.request_case.create');
    }

    /**
     * Show create form
     *
     * @return void
     */
    public function store(ConceptuaMathCaseStudyRequest $request)
    {
        $this->crm->createConceptuaCaseStudyLead($request);

        \Mail::to($request->get('email'))->send(new ConceptuaCaseStudyMail($request));

        return response()->json(['message' => 'Your message was sent.'], 200);
    }
}
