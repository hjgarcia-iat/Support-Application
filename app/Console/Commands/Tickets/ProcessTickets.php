<?php

namespace App\Console\Commands\Tickets;

use App\Ticket;
use App\Mail\ProcessTicketsMail;
use Illuminate\Console\Command;

class ProcessTickets extends Command
{
    protected $signature = 'tickets:process';

    protected $description = 'Process available support tickets';

    public function handle()
    {
        //get all tickets that do no have emailed processed
        $tickets = Ticket::with('files')->whereEmailProcessed(false)->limit(50)->get();

        foreach ($tickets as $ticket) {
            \Mail::to(config('mail.to.support_address'))->send(new ProcessTicketsMail($ticket));

            $ticket->email_processed = true;
            $ticket->save();
        }
    }
}
