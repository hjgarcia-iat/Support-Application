<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnRequest;
use App\Refund;
use App\Services\Spreadsheet\SpreadsheetInterface;

/**
 * Class ReturnRequestController
 * @package App\Http\Controllers
 */
class ReturnRequestController extends Controller
{
    /**
     * @var SpreadsheetInterface
     */
    private SpreadsheetInterface $spreadsheet;

    /**
     * ReturnRequestController constructor.
     * @param SpreadsheetInterface $spreadsheet
     */
    public function __construct(SpreadsheetInterface $spreadsheet)
    {
        $this->spreadsheet = $spreadsheet;
    }

    /**
     * Show create form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('return_request.create');
    }

    /**
     * Save the response to the spreadsheet
     *
     * @param ReturnRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ReturnRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->spreadsheet->save($request->all());

        return response()->json(['success' => true, 'message' => 'Your information was saved. We will get back to you shortly.']);
    }
}
