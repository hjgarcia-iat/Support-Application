<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Status;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return view('admin.statuses.index', compact('statuses'));
    }

    public function create()
    {
        return view('admin.statuses.create');
    }

    public function store()
    {
        Status::create([
            'type' => request('type'),
            'post' => request('post'),
        ]);

        return redirect(route('admin.statuses'))
            ->with('success', 'System status added.');
    }

    public function edit(Status $status)
    {
        return view('admin.statuses.edit', compact('status'));
    }

    public function update(Status $status)
    {
        $status->update([
            'type' => request('type'),
            'post' => request('post'),
        ]);

        return redirect(route('admin.statuses.edit', $status))
            ->with('success', 'Status was updated.');
    }

    public function delete(Status $status)
    {
        $status->delete();

        return redirect(route('admin.statuses'))
            ->with('success', 'Status was deleted.');

    }
}