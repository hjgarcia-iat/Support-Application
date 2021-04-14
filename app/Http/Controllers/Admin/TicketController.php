<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Http\Controllers\Controller;
use App\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::latest()->paginate(25);
        
        return view('admin.tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('admin.tickets.create',);
    }

    public function show(Ticket $ticket)
    {
        return view('admin.tickets.show',compact('ticket'));
    }

    public function delete(Ticket $ticket)
    {
        if ($ticket->files !== null) {
            foreach ($ticket->files as $file) {
                \Storage::disk('s3')->delete("contact-request/{$file->file}");
                File::find($file->id)->delete();
            }
        }

        $ticket->delete();

        return redirect(route('admin.tickets'))
            ->with('success','Ticket was deleted.');
    }

}