<?php

namespace App\Console\Commands;

use App\Contact;
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
        $contacts = Contact::where('created_at','<=', Carbon::now()->subMonths(1))->get();
        $count = $contacts->count();
        if($count > 0) {
            foreach ($contacts as $contact) {
                $contact->delete();
            }
        }

        \Mail::to(env('DESK_SUPPORT_EMAIL'))->send(new ContactsDeleted($count));

    }
}
