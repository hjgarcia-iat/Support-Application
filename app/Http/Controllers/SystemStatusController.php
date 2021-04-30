<?php

namespace App\Http\Controllers;

use App\Status;

class SystemStatusController extends Controller
{
    public function index()
    {
        $statuses = Status::latest()
            ->where('created_at', '>=', now()->subDays(7))
            ->get();

        return view('system_status.index', \compact('statuses'));
    }
}
