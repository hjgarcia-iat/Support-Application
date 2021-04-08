<?php

namespace Tests\Unit\Models;

use App\Ticket;
use App\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_the_correct_fields()
    {
        $data = [
            'reason' => 'reason',
            'name' => 'John Doe',
            'email' => 'jdoe@email.com',
            'district' => 'district',
            'subject' => 'subject',
            'details' => 'details',
            'email_processed' => true,
        ];

        Ticket::factory()->create($data);

        $this->assertDatabaseHas('tickets', $data);
    }

    public function test_it_has_a_file_relationship()
    {
        $ticket = Ticket::factory()->create();
        $file = File::factory()->create(['ticket_id' => $ticket->id]);

        $this->assertEquals($file->id, $ticket->files->first()->id);
    }
}
