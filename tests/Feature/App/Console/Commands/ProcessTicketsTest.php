<?php

namespace Tests\Feature\App\Console\Commands;


use App\Ticket;
use App\File;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;

class ProcessTicketsTest extends TestCase
{
    use RefreshDatabase, MailTracking;

    public function test_it_can_process_a_ticket()
    {
        Storage::fake('s3');

        \File::copyDirectory(base_path('tests/Files'), storage_path('framework/testing/disks/s3/contact-request'));

        $ticket = Ticket::factory()->create(['created_at' => Carbon::now()->subMonths(5)]);
        $fileA   = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '1.docx']);
        $fileB   = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '2.docx']);
        $fileC   = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '3.docx']);
        $fileD   = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '4.docx']);
        $fileE   = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '5.docx']);

        \Artisan::call('tickets:process');

        $this->seeEmailWasSent();
        $this->seeEmailContains($ticket->reason);
        $this->seeEmailContains($ticket->name);
        $this->seeEmailContains($ticket->email);
        $this->seeEmailContains($ticket->district);
        $this->seeEmailContains($ticket->details);
        $this->seeEmailContains(Storage::disk('s3')->url("contact-request/{$fileA->file}"));
        $this->seeEmailContains(Storage::disk('s3')->url("contact-request/{$fileB->file}"));
        $this->seeEmailContains(Storage::disk('s3')->url("contact-request/{$fileC->file}"));
        $this->seeEmailContains(Storage::disk('s3')->url("contact-request/{$fileD->file}"));
        $this->seeEmailContains(Storage::disk('s3')->url("contact-request/{$fileE->file}"));
        $this->assertDatabaseHas('tickets', [
            'id'=> $ticket->id,
            'email_processed' => true,
        ]);
    }

    public function test_a_user_that_already_has_emailed_processed_will_not_get_an_email()
    {
        Storage::fake('s3');

        \File::copyDirectory(base_path('tests/Files'), storage_path('framework/testing/disks/s3/contact-request'));

        $ticket = Ticket::factory()->create([
            'created_at' => Carbon::now()->subMonths(5),
            'email_processed' => true,
        ]);

        File::factory()->create(['ticket_id' => $ticket->id, 'file' => '1.docx']);
        File::factory()->create(['ticket_id' => $ticket->id, 'file' => '2.docx']);
        File::factory()->create(['ticket_id' => $ticket->id, 'file' => '3.docx']);
        File::factory()->create(['ticket_id' => $ticket->id, 'file' => '4.docx']);
        File::factory()->create(['ticket_id' => $ticket->id, 'file' => '5.docx']);

        \Artisan::call('tickets:process');

        $this->seeEmailWasNotSent();
    }
}