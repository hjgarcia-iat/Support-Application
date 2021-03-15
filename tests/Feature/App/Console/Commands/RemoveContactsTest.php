<?php

namespace Tests\Feature\App\Console\Commands;

use App\Contact;
use App\File;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;

class RemoveContactsTest extends TestCase
{
    use RefreshDatabase, MailTracking;

    public function test_it_deletes_contact_older_than_one_month()
    {
        Storage::fake('s3');

        \File::copyDirectory(base_path('tests/Files'), storage_path('framework/testing/disks/s3/contact-request'));

        $contactA = Contact::factory()->create(['created_at' => Carbon::now()->subMonths(5)]);
        $contactB = Contact::factory()->create(['created_at' => Carbon::now()->subMonths(4)]);
        $contactC = Contact::factory()->create(['created_at' => Carbon::now()->subMonths(3)]);
        $contactD = Contact::factory()->create(['created_at' => Carbon::now()->subMonths(2)]);
        $contactE = Contact::factory()->create(['created_at' => Carbon::now()->subMonths(1)]);
        $contactF = Contact::factory()->create();

        \Artisan::call('contacts:remove');

        $this->assertDatabaseMissing('contacts', ['id' => $contactA->id]);
        $this->assertDatabaseMissing('contacts', ['id' => $contactB->id]);
        $this->assertDatabaseMissing('contacts', ['id' => $contactC->id]);
        $this->assertDatabaseMissing('contacts', ['id' => $contactD->id]);
        $this->assertDatabaseMissing('contacts', ['id' => $contactE->id]);
        $this->assertDatabaseHas('contacts', ['id' => $contactF->id]);

        $this->seeEmailWasSent();
        $this->seeEmailContains("5 records were deleted.");
    }

    public function test_it_deletes_contact_older_than_one_month_and_also_deleted_all_associated_files()
    {
        Storage::fake('s3');

        \File::copyDirectory(base_path('tests/Files'), storage_path('framework/testing/disks/s3/contact-request'));

        $contact = Contact::factory()->create(['created_at' => Carbon::now()->subMonths(5)]);
        $fileA   = File::factory()->create(['contact_id' => $contact->id, 'file' => '1.docx']);
        $fileB   = File::factory()->create(['contact_id' => $contact->id, 'file' => '2.docx']);
        $fileC   = File::factory()->create(['contact_id' => $contact->id, 'file' => '3.docx']);
        $fileD   = File::factory()->create(['contact_id' => $contact->id, 'file' => '4.docx']);
        $fileE   = File::factory()->create(['contact_id' => $contact->id, 'file' => '5.docx']);

        \Artisan::call('contacts:remove');

        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
        $this->assertDatabaseMissing('files', ['id' => $fileA->id]);
        $this->assertDatabaseMissing('files', ['id' => $fileB->id]);
        $this->assertDatabaseMissing('files', ['id' => $fileC->id]);
        $this->assertDatabaseMissing('files', ['id' => $fileD->id]);
        $this->assertDatabaseMissing('files', ['id' => $fileE->id]);
        Storage::disk('s3')->assertMissing("contact-request/$fileA->file");
        Storage::disk('s3')->assertMissing("contact-request/$fileB->file");
        Storage::disk('s3')->assertMissing("contact-request/$fileC->file");
        Storage::disk('s3')->assertMissing("contact-request/$fileD->file");
        Storage::disk('s3')->assertMissing("contact-request/$fileE->file");

        $this->seeEmailWasSent();
        $this->seeEmailContains("1 record was deleted.");
    }
}