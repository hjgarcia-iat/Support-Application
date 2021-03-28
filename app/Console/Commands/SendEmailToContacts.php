<?php

namespace App\Console\Commands;

use App\Contact;
use App\Mail\ContactRequest;
use Illuminate\Console\Command;

class SendEmailToContacts extends Command
{
    protected $signature = 'contacts:email';

    protected $description = 'Send emails to contact';

    public function handle()
    {
        //get all contact that do no have emailed processed
        $contacts = Contact::whereEmailProcessed(false)->limit(50)->get();

        foreach ($contacts as $contact) {
            \Mail::to(config('mail.to.support_address'))->send(new ContactRequest($contact));

            $contact->email_processed = true;
            $contact->save();
        }
    }
}
