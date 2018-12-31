<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestADemoForm;
use App\Mail\RequestADemoMail;
use App\Services\CRMInterface;

/**
 * Class RequestDemoController
 * @package App\Http\Controllers
 */
class RequestDemoController extends Controller
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('conceptua.request_demo.create');
    }

    public function store(RequestADemoForm $request)
    {
        $this->crm->createConceptuaDemoRequestLead($request);

        \Mail::to($request->get('email'))->send(new RequestADemoMail($request));

        return response()->json([
            'success' => true,
            'message' => 'The request was sent!'
        ]);
    }
}
