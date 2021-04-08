<?php

namespace App\Http\Controllers;

class SystemStatusController extends Controller
{
    public function index()
    {
        return view('system_status.index');
    }
}