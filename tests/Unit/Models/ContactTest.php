<?php

namespace Tests\Unit\Models;

use App\Contact;
use App\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
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
        ];

        Contact::factory()->create($data);

        $this->assertDatabaseHas('contacts', $data);
    }

    public function test_it_has_an_image_relationship()
    {
        $contact = Contact::factory()->create();
        $file = File::factory()->create(['contact_id' => $contact->id]);

        $this->assertEquals($file->id, $contact->files->first()->id);
    }
}
