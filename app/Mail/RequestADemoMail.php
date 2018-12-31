<?php

namespace App\Mail;

use App\Http\Requests\RequestADemoForm;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class RequestADemoMail
 * @package App\Mail
 */
class RequestADemoMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var RequestADemoForm
     */
    private $request;

    /**
     * Create a new message instance.
     *
     * @param RequestADemoForm $request
     */
    public function __construct(RequestADemoForm $request)
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
        return $this->view('mail.conceptua-math-demo-request', [
            'first_name' => $this->request->get('first_name'),
            'last_name'  => $this->request->get('last_name'),
        ])->subject('Your request for a Conceptua Math Product Demonstration')
            ->from('akhalsa@activatelearning.com');
    }
}
