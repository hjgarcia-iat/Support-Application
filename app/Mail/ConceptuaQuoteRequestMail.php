<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Requests\RequestAQuoteForm;

class ConceptuaQuoteRequestMail extends Mailable
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
    public function __construct(RequestAQuoteForm $request)
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
        return $this->view('mail.conceptua-math-quote-request', [
            'first_name' => $this->request->get('first_name'),
        ])->from('info@activatelearning.com')
            ->subject('Your request for a Conceptua Math Price Quote');
    }
}
