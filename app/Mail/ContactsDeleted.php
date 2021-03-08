<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ContactsDeleted extends Mailable
{
    protected int $count;

    public function __construct($count)
    {
        $this->count = $count;
    }

    public function build()
    {
        return $this->view('emails.contacts-deleted',['count' => $this->count]);
    }
}