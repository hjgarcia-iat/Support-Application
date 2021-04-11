<?php

namespace App\Http\Controllers;

use App\Status;

class SystemStatusController extends Controller
{
    public function index()
    {
        $statuses = Status::latest()->get();

        return view('system_status.index', \compact('statuses'));
    }
}