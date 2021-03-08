<?php

namespace Tests\Feature\App\Console\Commands;

use App\Contact;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
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

        $contactA = Contact::factory()->create(['created_at' => Carbon::now()->subMonths(4),'file' => '1.docx']);
        $contactB = Contact::factory()->create(['created_at' => Carbon::now()->subMonths(3), 'file' => '2.docx']);
        $contactC = Contact::factory()->create(['created_at' => Carbon::now()->subMonths(2), 'file' => '3.docx']);
        $contactD = Contact::factory()->create(['created_at' => Carbon::now()->subMonths(1), 'file' => '4.docx']);
        $contactE = Contact::factory()->create(['file' => '5.docx']);
        $contactF = Contact::factory()->create(['created_at' => Carbon::now()->subMonths(1)]);

        \Artisan::call('contacts:remove');

        $this->assertDatabaseMissing('contacts', ['id' => $contactA->id]);
        $this->assertDatabaseMissing('contacts', ['id' => $contactB->id]);
        $this->assertDatabaseMissing('contacts', ['id' => $contactC->id]);
        $this->assertDatabaseMissing('contacts', ['id' => $contactD->id]);
        $this->assertDatabaseMissing('contacts', ['id' => $contactF->id]);
        $this->assertDatabaseHas('contacts', ['id' => $contactE->id]);

        Storage::disk('s3')->assertMissing("contact-request/$contactA->file");
        Storage::disk('s3')->assertMissing("contact-request/$contactB->file");
        Storage::disk('s3')->assertMissing("contact-request/$contactC->file");
        Storage::disk('s3')->assertMissing("contact-request/$contactD->file");
        Storage::disk('s3')->assertExists("contact-request/$contactE->file");

        $this->seeEmailWasSent();
        $this->seeEmailContains("5 records were deleted.");
    }
}