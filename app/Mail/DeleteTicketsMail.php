<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class DeleteTicketsMail extends Mailable
{
    protected int $count;

    public function __construct($count)
    {
        $this->count = $count;
    }

    public function build()
    {
        return $this->subject('Tickets Deleted')
                    ->view('mail.delete_tickets',['count' => $this->count]);
    }
}