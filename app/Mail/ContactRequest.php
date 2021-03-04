<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'reason' => request()->get('reason'),
            'name' => request()->get('name'),
            'email' => request()->get('email'),
            'district' => request()->get('district'),
            'details' => request()->get('details'),
        ];

        return $this->view('mail.contact_request')
            ->from(request()->get('email'))
            ->subject("[". request('reason') ."]".request('subject'))
            ->with($data);
    }
}
