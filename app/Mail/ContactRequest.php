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

    /**
     * @var Contact $contact
     */
    protected $contact;

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
            'files'    => File::whereContactId($this->contact->id)->get(),
        ];

        return $this->view('mail.contact_request')
                    ->from($this->contact->email)
                    ->subject("[" . $this->contact->reason . "] " . $this->contact->subject)
                    ->with($data);
    }
}
