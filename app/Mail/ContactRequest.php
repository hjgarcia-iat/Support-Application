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
    public function build(): ContactRequest
    {
        $data = [
            'reason'   => $this->contact->reason,
            'name'     => $this->contact->name,
            'email'    => $this->contact->email,
            'district' => $this->contact->district,
            'details'  => $this->contact->details,
            'file'     => ($this->contact->file !== null) ? \Storage::disk('s3')->url("contact-request/{$this->contact->file}") : null,
        ];

        return $this->view('mail.contact_request')
                    ->from(request()->get('email'))
                    ->subject("[" . request('reason') . "]" . request('subject'))
                    ->with($data);
    }
}
