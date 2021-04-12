<?php

namespace App\Http\Controllers;

use App\Status;
use Carbon\Carbon;

class SystemStatusController extends Controller
{
    public function index()
    {
        $statuses = Status::latest()
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->get();

        return view('system_status.index', \compact('statuses'));
    }
}
