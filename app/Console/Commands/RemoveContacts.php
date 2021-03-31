<?php

namespace App\Console\Commands;

use App\Contact;
use App\File;
use App\Mail\ContactsDeleted;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveContacts extends Command
{
    protected $signature = 'contacts:remove';

    protected $description = 'Remove Contacts from Database';

    public function handle()
    {
        $count = 0;

        $contacts = Contact::where('created_at','<=', Carbon::now()->subMonths(1))
            ->whereEmailProcessed(true)
            ->get();

        $count = $contacts->count();

        if($count > 0) {
            foreach ($contacts as $contact) {
                if($contact->files !== null) {
                    foreach ($contact->files as $file) {
                        \Storage::disk('s3')->delete("contact-request/{$file->file}");
                        File::find($file->id)->delete();
                    }
                }

                $contact->delete();
            }

            \Mail::to(config('mail.to.dev_email'))->send(new ContactsDeleted($count));
        }
    }
}
