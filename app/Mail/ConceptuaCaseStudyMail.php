<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConceptuaCaseStudyMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Request
     */
    private $request;

    /**
     * Create a new message instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
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
        return $this->view('mail.conceptua-case-study', [
            'first_name' => $this->request->get('first_name'),
        ])->subject('Your request for a Conceptua Math Case Study')
            ->from('info@activatelearning.com');
    }
}
