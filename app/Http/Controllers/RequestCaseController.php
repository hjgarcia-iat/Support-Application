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
     * Show creatae form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('conceptua.request_case.create');
    }

    /**
     * Show create form
     *
     * @param ConceptuaMathCaseStudyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ConceptuaMathCaseStudyRequest $request)
    {
        $this->crm->createConceptuaCaseStudyLead($request);

        \Mail::to($request->get('email'))->send(new ConceptuaCaseStudyMail($request));

        return response()->json(['message' => 'Your message was sent.'], 200);
    }
}
