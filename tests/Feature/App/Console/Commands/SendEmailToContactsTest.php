<?php

namespace Tests\Feature\App\Console\Commands;


use App\Contact;
use App\File;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;

class SendEmailToContactsTest extends TestCase
{
    use RefreshDatabase, MailTracking;

    public function test_we_can_send_email_to_support_from_contacts_whose_emails_have_not_been_processed()
    {
        Storage::fake('s3');

        \File::copyDirectory(base_path('tests/Files'), storage_path('framework/testing/disks/s3/contact-request'));

        $contact = Contact::factory()->create(['created_at' => Carbon::now()->subMonths(5)]);
        $fileA   = File::factory()->create(['contact_id' => $contact->id, 'file' => '1.docx']);
        $fileB   = File::factory()->create(['contact_id' => $contact->id, 'file' => '2.docx']);
        $fileC   = File::factory()->create(['contact_id' => $contact->id, 'file' => '3.docx']);
        $fileD   = File::factory()->create(['contact_id' => $contact->id, 'file' => '4.docx']);
        $fileE   = File::factory()->create(['contact_id' => $contact->id, 'file' => '5.docx']);

        \Artisan::call('contacts:email');

        $this->seeEmailWasSent();
        $this->seeEmailContains($contact->reason);
        $this->seeEmailContains($contact->name);
        $this->seeEmailContains($contact->email);
        $this->seeEmailContains($contact->district);
        $this->seeEmailContains($contact->details);
        $this->seeEmailContains(Storage::disk('s3')->url("contact-request/{$fileA->file}"));
        $this->seeEmailContains(Storage::disk('s3')->url("contact-request/{$fileB->file}"));
        $this->seeEmailContains(Storage::disk('s3')->url("contact-request/{$fileC->file}"));
        $this->seeEmailContains(Storage::disk('s3')->url("contact-request/{$fileD->file}"));
        $this->seeEmailContains(Storage::disk('s3')->url("contact-request/{$fileE->file}"));

    }
}