<?php

namespace App\Mail;

use App\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactRequest extends Mailable
{
    use Queueable, SerializesModels;

    protected Contact $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'reason'   => $this->contact->reason,
            'name'     => $this->contact->name,
            'email'    => $this->contact->email,
            'district' => $this->contact->district,
            'details'  => $this->contact->details,
            'files'     => ($this->contact->files !== null) ? $this->contact->files : null,
        ];

        return $this->view('mail.contact_request')
                    ->from($this->contact->email)
                    ->subject("[" . $this->contact->reason . "] " . $this->contact->subject)
                    ->with($data);
    }
}
