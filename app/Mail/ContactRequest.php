<?php

namespace App\Mail;

use App\Http\Requests\ContactFormRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var ContactFormRequest $request
     */
    protected $request;
    /**
     * @var String $filename
     */
    protected $filename;

    public function __construct(ContactFormRequest $request, $filename)
    {
        $this->request = $request;
        $this->filename = $filename;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'reason' => $this->request->get('reason'),
            'name' => $this->request->get('name'),
            'email' => $this->request->get('email'),
            'district' => $this->request->get('district'),
            'details' => $this->request->get('details'),
            'file' => \Storage::disk('s3')->url("contact-request/{$this->filename}"),
        ];

        return $this->view('mail.contact_request')
            ->from(request()->get('email'))
            ->subject("[". request('reason') ."]".request('subject'))
            ->with($data);
    }
}
