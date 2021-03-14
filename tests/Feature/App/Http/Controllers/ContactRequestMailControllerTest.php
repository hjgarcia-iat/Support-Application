<?php

namespace Tests\App\Http\Controllers;

use App\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;

/**
 * Class ContactRequestMailControllerTest
 * @package Tests\Feature
 */
class ContactRequestMailControllerTest extends TestCase
{
    use RefreshDatabase, MailTracking;

    public function test_we_can_send_an_email_if_we_have_a_contact_not_associated_to_files()
    {
        $contact = Contact::factory()->create();

        $response = $this->post(route('contact_request.mail.store', ['id' => $contact->id]));

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->seeEmailWasSent();
        $this->seeEmailSubjectEquals("[" . $contact['reason'] . "] " . $contact['subject']);
        $this->seeEmailContains($contact['reason']);
        $this->seeEmailContains($contact['name']);
        $this->seeEmailContains($contact['email']);
        $this->seeEmailContains($contact['district']);
        $this->seeEmailContains($contact['details']);
    }

    public function test_we_can_send_an_email_if_we_have_a_contact_and_files_associated()
    {
        Storage::fake('s3');
        $contact = Contact::factory()->create();
        //post 2 images to the file area
        $fileA = UploadedFile::fake()->image('image.jpg');
        $fileB = UploadedFile::fake()->image('image2.jpg');
        $this->post(route('files.store'), ['id' => $contact->id, 'file' => $fileA]);
        $this->post(route('files.store'), ['id' => $contact->id, 'file' => $fileB]);

        $response = $this->post(route('contact_request.mail.store', ['id' => $contact->id]));

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->seeEmailWasSent();
        $this->seeEmailSubjectEquals("[" . $contact['reason'] . "] " . $contact['subject']);
        $this->seeEmailContains($contact['reason']);
        $this->seeEmailContains($contact['name']);
        $this->seeEmailContains($contact['email']);
        $this->seeEmailContains($contact['district']);
        $this->seeEmailContains($contact['details']);
        $contact->files->each(function ($file) {
            $this->seeEmailContains(Storage::disk('s3')->url("contact-request/{$file->file}"));
        });
    }
}
