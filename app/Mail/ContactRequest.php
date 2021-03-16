<?php

namespace App\Mail;

use App\Contact;
use App\File;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactRequest extends Mailable
{
    use Queueable, SerializesModels;

    protected int $id;

    public function __construct($id)
    {
        $this->id = (int)$id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $contact = Contact::find($this->id);

        $data = [
            'reason'   => $contact->reason,
            'name'     => $contact->name,
            'email'    => $contact->email,
            'district' => $contact->district,
            'details'  => $contact->details,
            'files'    => File::whereContactId($contact->id)->get(),
        ];

        return $this->view('mail.contact_request')
                    ->from($contact->email)
                    ->subject("[" . $contact->reason . "] " . $contact->subject)
                    ->with($data);
    }
}
