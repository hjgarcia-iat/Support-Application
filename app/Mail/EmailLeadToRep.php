<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class EmailLeadToRep
 * @package App\Mail
 */
class EmailLeadToRep extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var string
     */
    private $leadId;

    /**
     * Create a new message instance.
     *
     * @param Request $request
     * @param $leadId
     */
    public function __construct(Request $request, $leadId)
    {
        $this->request = $request;
        $this->leadId  = $leadId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.lead', [
            'leadId' => $this->leadId,
        ])->from(env('GENERAL_ACTIVATE_LEARNING_EMAIL'))->subject('New Conceptua Math Lead');
    }
}
