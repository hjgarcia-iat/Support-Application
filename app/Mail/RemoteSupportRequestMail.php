<?php

namespace App\Mail;

use App\Http\Requests\RemoteSupportRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemoteSupportRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var RemoteSupportRequest
     */
    private $request;

    /**
     * Create a new message instance.
     *
     * @param RemoteSupportRequest $request
     */
    public function __construct(RemoteSupportRequest  $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.remote_support_request', [
            'name' => $this->request->get('name'),
            'email' => $this->request->get('email'),
            'student_name' => $this->request->get('student_name'),
            'teacher_name' => $this->request->get('teacher_name'),
            'district' => $this->request->get('district'),
            'state' => $this->request->get('state'),
            'subject' => $this->request->get('subject'),
            'comment' => $this->request->get('comment'),
        ])->from($this->request->get('email'))
            ->subject('Student Request Help');
    }
}
