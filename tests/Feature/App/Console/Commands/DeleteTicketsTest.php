<?php

namespace Tests\Feature\App\Console\Commands;

use App\Ticket;
use App\File;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;

class DeleteTicketsTest extends TestCase
{
    use RefreshDatabase, MailTracking;

    public function test_it_deletes_tickets_older_than_one_month()
    {
        Storage::fake('s3');

        \File::copyDirectory(base_path('tests/Files'), storage_path('framework/testing/disks/s3/contact-request'));

        $ticketA = Ticket::factory()->create(['email_processed' => true, 'created_at' => Carbon::now()->subMonths(5)]);
        $ticketB = Ticket::factory()->create(['email_processed' => true, 'created_at' => Carbon::now()->subMonths(4)]);
        $ticketC = Ticket::factory()->create(['email_processed' => true, 'created_at' => Carbon::now()->subMonths(3)]);
        $ticketD = Ticket::factory()->create(['email_processed' => true, 'created_at' => Carbon::now()->subMonths(2)]);
        $ticketE = Ticket::factory()->create(['email_processed' => true, 'created_at' => Carbon::now()->subMonths(1)]);
        $ticketF = Ticket::factory()->create();

        \Artisan::call('tickets:delete');

        $this->assertDatabaseMissing('tickets', ['id' => $ticketA->id]);
        $this->assertDatabaseMissing('tickets', ['id' => $ticketB->id]);
        $this->assertDatabaseMissing('tickets', ['id' => $ticketC->id]);
        $this->assertDatabaseMissing('tickets', ['id' => $ticketD->id]);
        $this->assertDatabaseMissing('tickets', ['id' => $ticketE->id]);
        $this->assertDatabaseHas('tickets', ['id' => $ticketF->id]);

        $this->seeEmailWasSent();
        $this->seeEmailContains("5 tickets were deleted.");
    }

    public function test_it_deletes_tickets_older_than_one_month_and_also_deletes_all_associated_files()
    {
        Storage::fake('s3');

        \File::copyDirectory(base_path('tests/Files'), storage_path('framework/testing/disks/s3/contact-request'));

        $ticket = Ticket::factory()->create([
            'created_at' => Carbon::now()->subMonths(5),
            'email_processed' => true,
        ]);

        $fileA   = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '1.docx']);
        $fileB   = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '2.docx']);
        $fileC   = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '3.docx']);
        $fileD   = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '4.docx']);
        $fileE   = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '5.docx']);

        \Artisan::call('tickets:delete');

        $this->assertDatabaseMissing('tickets', ['id' => $ticket->id]);
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
    }

    public function test_it_will_not_delete_a_ticket_if_the_ticket_has_not_been_processed()
    {
        Storage::fake('s3');

        \File::copyDirectory(base_path('tests/Files'), storage_path('framework/testing/disks/s3/contact-request'));

        $ticket = Ticket::factory()->create([
            'created_at' => Carbon::now()->subMonths(5),
            'email_processed' => false,
        ]);
        $fileA   = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '1.docx']);
        $fileB   = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '2.docx']);
        $fileC   = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '3.docx']);
        $fileD   = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '4.docx']);
        $fileE   = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '5.docx']);

        \Artisan::call('tickets:delete');

        $this->assertDatabaseHas('tickets', ['id' => $ticket->id]);
        $this->assertDatabaseHas('files', ['id' => $fileA->id]);
        $this->assertDatabaseHas('files', ['id' => $fileB->id]);
        $this->assertDatabaseHas('files', ['id' => $fileC->id]);
        $this->assertDatabaseHas('files', ['id' => $fileD->id]);
        $this->assertDatabaseHas('files', ['id' => $fileE->id]);
        Storage::disk('s3')->assertExists("contact-request/$fileA->file");
        Storage::disk('s3')->assertExists("contact-request/$fileB->file");
        Storage::disk('s3')->assertExists("contact-request/$fileC->file");
        Storage::disk('s3')->assertExists("contact-request/$fileD->file");
        Storage::disk('s3')->assertExists("contact-request/$fileE->file");

        $this->seeEmailWasSent();
        $this->seeEmailContains("No tickets were deleted from the system.");
    }

    public function test_an_email_is_sent_out_even_if_no_tickets_are_deleted()
    {
        \Artisan::call('tickets:delete');

        $this->seeEmailWasSent();
        $this->seeEmailContains("No tickets were deleted from the system.");
    }
}