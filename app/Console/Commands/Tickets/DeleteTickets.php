<?php

namespace App\Console\Commands\Tickets;

use App\Ticket;
use App\File;
use App\Mail\DeleteTicketsMail;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteTickets extends Command
{
    protected $signature = 'tickets:delete';

    protected $description = 'Remove Tickets from the systems';

    public function handle()
    {
        $tickets = Ticket::where('created_at','<=', Carbon::now()->subMonths(1))
                          ->whereEmailProcessed(true)
                          ->get();

        $count = $tickets->count();

        if($count > 0) {
            foreach ($tickets as $ticket) {
                if($ticket->files !== null) {
                    foreach ($ticket->files as $file) {
                        \Storage::disk('s3')->delete("contact-request/{$file->file}");
                        File::find($file->id)->delete();
                    }
                }

                $ticket->delete();
            }
        }

        \Mail::to(config('mail.to.dev_email'))->send(new DeleteTicketsMail($count));
    }
}
