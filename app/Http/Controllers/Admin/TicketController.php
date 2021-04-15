<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::latest();

        if (request()->has('query')) {
            $tickets = $tickets->where('name', 'LIKE', "%" . request('query') . "%")
                               ->orWhere('email', 'LIKE', "%" . request('query') . "%")
                               ->orWhere('subject', 'LIKE', "%" . request('query') . "%");
        }

        $tickets = $tickets->paginate(25)->appends('query', request('query'));

        return view('admin.tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('admin.tickets.create',);
    }

    public function delete(Ticket $ticket)
    {
        if ($ticket->files !== null) {
            foreach ($ticket->files as $file) {
                \Storage::disk('s3')->delete("contact - request /{
                $file->file}");
                File::find($file->id)->delete();
            }
        }

        $ticket->delete();

        return redirect(route('admin.tickets'))
            ->with('success', 'Ticket was deleted.');
    }

}