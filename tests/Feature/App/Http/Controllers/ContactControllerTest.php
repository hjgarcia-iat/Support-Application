<?php

namespace Tests\App\Http\Controllers;

use App\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;

/**
 * Class ContactControllerTest
 * @package Tests\Feature
 */
class ContactControllerTest extends TestCase
{
    use RefreshDatabase, MailTracking;


    public function test_we_can_view_the_form()
    {
        $response = $this->get(route('contact_request.create'));

        $response->assertStatus(200);
        $response->assertViewIs('contact_request.create');
    }

    public function test_the_contact_form_can_submit_with_a_file()
    {
        //fake s3
        Storage::fake('s3');
        //upload files to the server
        $file = UploadedFile::fake()->image('image.jpg');
        //make a call to the contact controller to save information for the request 
        $contactInfoResponse = $this->from(route('contact_request.create'))
            ->post(route('contact_request.store'), $this->validData([
                'file' => $file,
            ]));

        //make a call to File Controller to upload the files
        $imageResponse = $this->withoutExceptionHandling()->post(route('files.store'), [
            'id' => 1,
            'file' => $file,
        ]);


        $contactInfoResponse->assertStatus(200);
        $contactInfoResponse->assertJson([
            'success' => true,
            'id'      => Contact::whereEmail($this->validData()['email'])->first()->id,
        ]);

        $imageResponse->assertStatus(200);
        $imageResponse->assertJson(['success' => true]);


        Storage::disk('s3')->assertExists("contact-request/{$file->hashName()}");

        $this->seeEmailWasSent();
        $this->seeEmailSubjectEquals("[" . $this->validData()['reason'] . "] " . $this->validData()['subject']);
        $this->seeEmailContains($this->validData()['reason']);
        $this->seeEmailContains($this->validData()['name']);
        $this->seeEmailContains($this->validData()['email']);
        $this->seeEmailContains($this->validData()['district']);
        $this->seeEmailContains($this->validData()['details']);
        $this->seeEmailContains($this->validData()['details']);
        $this->seeEmailContains(Storage::disk('s3')->url("contact-request/{$file->hashName()}"));

        $this->assertDatabaseHas('contacts', [
            'reason'   => $this->validData()['reason'],
            'name'     => $this->validData()['name'],
            'email'    => $this->validData()['email'],
            'district' => $this->validData()['district'],
            'subject'  => $this->validData()['subject'],
            'details'  => $this->validData()['details'],
        ]);

        $this->assertDatabaseHas('files', [
            'contact_id' => Contact::whereEmail($this->validData()['email'])->first()->id,
            'file'       => $file->hashName(),
        ]);
    }

    /**
     * Get valid form data
     *
     * @param array $overrides
     * @return array
     */
    private function validData($overrides = []): array
    {
        return array_merge([
            'reason'   => 'Curriculum Question',
            'name'     => 'Jane Doe',
            'email'    => 'jdoe@email.com',
            'district' => 'district',
            'subject'  => 'subject',
            'details'  => 'details',
        ], $overrides);
    }
}