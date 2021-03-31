<?php

namespace Tests\Unit\Models;

use App\Contact;
use App\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FileTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_the_correct_fields()
    {
        $data = [
            'contact_id' => 1,
            'file' => 'image.jpg',
        ];

        File::factory()->create($data);

        $this->assertDatabaseHas('files', $data);
    }

    public function test_it_has_a_contact_relationship()
    {
        $contact = Contact::factory()->create();
        $file = File::factory()->create(['contact_id' => $contact->id]);

        $this->assertEquals($contact->id, $file->contact->id);
    }
}
