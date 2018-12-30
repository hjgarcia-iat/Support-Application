<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DigitalSetupRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.digital_setup',
            [
                'name'             => request()->get('name'),
                'email'            => request()->get('email'),
                'po_number'        => request()->get('po_number'),
                'district'         => request()->get('district'),
                'start_date'       => request()->get('start_date'),
                'curriculum'       => request()->get('curriculum'),
                'district_manager' => request()->get('district_manager'),
                'teachers'         => request()->get('teachers'),
                'dm_name'          => request()->get('dm_name'),
                'dm_email'         => request()->get('dm_email'),
            ])->from(request()->get('email'))
            ->subject('NEW ORDER - IDE setup form');
    }
}
