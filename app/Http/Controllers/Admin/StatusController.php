<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StatusRequest;
use App\Status;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::latest()->paginate(25);
        return view('admin.statuses.index', compact('statuses'));
    }

    public function create()
    {
        return view('admin.statuses.create');
    }

    public function store(StatusRequest $request)
    {
        Status::create([
            'type' => $request->get('type'),
            'post' => $request->get('post'),
        ]);

        return redirect(route('admin.statuses'))
            ->with('success', 'System status added.');
    }

    public function edit(Status $status)
    {
        return view('admin.statuses.edit', compact('status'));
    }

    public function update(Status $status, StatusRequest $request)
    {
        $status->update([
            'type' => $request->get('type'),
            'post' => $request->get('post'),
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