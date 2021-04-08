<?php

namespace App\Mail;

use App\Ticket;
use App\File;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProcessTicketsMail extends Mailable
{
    use Queueable, SerializesModels;

    protected Ticket $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'reason'   => $this->ticket->reason,
            'name'     => $this->ticket->name,
            'email'    => $this->ticket->email,
            'district' => $this->ticket->district,
            'details'  => $this->ticket->details,
            'files'    => $this->ticket->files,
        ];

        return $this->view('mail.process_tickets')
                    ->from($this->ticket->email)
                    ->subject("[" . $this->ticket->reason . "] " . $this->ticket->subject)
                    ->with($data);
    }
}
