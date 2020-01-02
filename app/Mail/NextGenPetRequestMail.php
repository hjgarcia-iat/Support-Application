<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class NextGenPetRequestMail
 * @package App\Mail
 */
class NextGenPetRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(request('email'))
            ->view('mail.nextgen_pet',[
                'institution_name' => request('institution_name'),
                'name' => request('name'),
                'email' => request('email'),
                'po_number' => request('po_number'),
                'inquiry' => request('inquiry'),
                'comment' => request('comment'),
            ]);
    }
}
