<?php

namespace Tests\Feature\App\Http\Controllers\Admin;

use App\File;
use App\Ticket;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Class TicketControllerTest
 * @package Tests\Feature
 */
class TicketControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_we_can_see_all_tickets()
    {
        $user    = User::factory()->create();
        $tickets = Ticket::factory(4)->create();

        $response = $this->actingAs($user)->get(route("admin.tickets"));

        $response->assertStatus(200);
        $response->assertViewIs("admin.tickets.index");
        $tickets->each(function ($ticket) use ($response) {
            $response->assertSee($ticket->id);
        });
    }

    public function test_we_can_delete_a_ticket()
    {
        $user   = User::factory()->create();
        $ticket = Ticket::factory()->create();

        $response = $this->actingAs($user)->get(route("admin.tickets.delete", $ticket));

        $response->assertRedirect(route('admin.tickets'));
        $this->assertDatabaseMissing('tickets', [
            'id' => $ticket->id,
        ]);
    }

    public function test_we_can_delete_a_ticket_and_associated_files()
    {
        Storage::fake('s3');

        \File::copyDirectory(base_path('tests/Files'), storage_path('framework/testing/disks/s3/contact-request'));
        $user   = User::factory()->create();
        $ticket = Ticket::factory()->create();
        $fileA  = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '1.docx']);
        $fileB  = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '2.docx']);
        $fileC  = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '3.docx']);
        $fileD  = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '4.docx']);
        $fileE  = File::factory()->create(['ticket_id' => $ticket->id, 'file' => '5.docx']);

        $response = $this->actingAs($user)->get(route("admin.tickets.delete", $ticket));

        $response->assertRedirect(route('admin.tickets'));
        $this->assertDatabaseMissing('tickets', ['id' => $ticket->id]);
        $this->assertDatabaseMissing('files', ['id' => $fileA->id]);
        $this->assertDatabaseMissing('files', ['id' => $fileB->id]);
        $this->assertDatabaseMissing('files', ['id' => $fileC->id]);
        $this->assertDatabaseMissing('files', ['id' => $fileD->id]);
        $this->assertDatabaseMissing('files', ['id' => $fileE->id]);
        $this->assertDatabaseMissing('tickets', [
            'id' => $ticket->id,
        ]);
        Storage::disk('s3')->assertMissing("contact-request/$fileA->file");
        Storage::disk('s3')->assertMissing("contact-request/$fileB->file");
        Storage::disk('s3')->assertMissing("contact-request/$fileC->file");
        Storage::disk('s3')->assertMissing("contact-request/$fileD->file");
        Storage::disk('s3')->assertMissing("contact-request/$fileE->file");
    }


    public function test_we_cannot_delete_a_status_that_does_not_exist()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("admin.tickets.delete", 'does-not-exist'));

        $response->assertStatus(404);
    }


    public function test_we_cannot_see_the_tickets_page_if_we_are_not_authenticated()
    {
        $this->get(route("admin.tickets"))->assertRedirect(route('login'));
        $this->get(route("admin.tickets.delete", 'ticket'))->assertRedirect(route('login'));
    }
}