<?php

namespace Tests\Unit\Models;

use App\Ticket;
use App\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FileTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_the_correct_fields()
    {
        $data = [
            'ticket_id' => 1,
            'file' => 'image.jpg',
        ];

        File::factory()->create($data);

        $this->assertDatabaseHas('files', $data);
    }

    public function test_it_has_a_ticket_relationship()
    {
        $ticket = Ticket::factory()->create();
        $file = File::factory()->create(['ticket_id' => $ticket->id]);

        $this->assertEquals($ticket->id, $file->ticket->id);
    }
}
