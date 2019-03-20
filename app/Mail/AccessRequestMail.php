<?php

namespace App\Mail;

use App\Http\Requests\AccessFormRequest;
use App\Zip;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class AccessRequestMail
 * @package App\Mail
 */
class AccessRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $zip = Zip::whereZipCode(request()->get('zip_code'))->first();

        $data = [
            'first_name'      => request()->get('first_name'),
            'last_name'       => request()->get('last_name'),
            'email'           => request()->get('email'),
            'school_district' => request()->get('district'),
            'school'          => request()->get('school'),
            'sales_rep'   => request()->get('sales_rep'),
            'resources'   => request()->get('resource'),
            'access_type' => request()->get('access_type'),
            'version'     => request()->get('version'),
            'ebooks'      => request()->get('ebook_list'),
            'time_frame'  => request()->get('time_frame'),
            'note'        => request()->get('note'),
        ];

        if ($zip) {
            $data['zip_code'] = $zip->zip_code;
            $data['city']     = $zip->city;
            $data['state']    = $zip->state;
        }

        return $this->view('mail.access_request')
            ->from(request()->get('sales_rep'))
            ->subject('Form Submission - Demo Portal Access')
            ->with($data);
    }
}
