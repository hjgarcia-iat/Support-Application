<?php

namespace Tests\Feature\ContactForm;

use App\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;

/**
 * Class StoreContactFormTest
 * @package Tests\Feature
 */
class StoreContactFormTest extends TestCase
{
    use MailTracking, RefreshDatabase;

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

    public function test_we_can_submit_the_contact_form_without_a_file()
    {
        $response = $this->withoutExceptionHandling()->from(route('contact_request.create'))
            ->post(route('contact_request.store'), $this->validData());

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->seeEmailWasSent();
        $this->seeEmailSubjectEquals("[" . $this->validData()['reason'] . "]" . $this->validData()['subject']);
        $this->seeEmailContains($this->validData()['reason']);
        $this->seeEmailContains($this->validData()['name']);
        $this->seeEmailContains($this->validData()['email']);
        $this->seeEmailContains($this->validData()['district']);
        $this->seeEmailContains($this->validData()['details']);
        $this->seeEmailContains($this->validData()['details']);
        $this->seeEmailDoesNotContain('View File');

        $this->assertDatabaseHas('contacts', [
            'reason'   => $this->validData()['reason'],
            'name'     => $this->validData()['name'],
            'email'    => $this->validData()['email'],
            'district' => $this->validData()['district'],
            'subject'  => $this->validData()['subject'],
            'details'  => $this->validData()['details'],
        ]);

        $this->assertDatabaseMissing('files', [
            'contact_id' => Contact::whereEmail($this->validData()['email'])->first()->id,
        ]);
    }

    public function test_file_for_required_uploads_can_submit()
    {
        Storage::fake('s3');
        $fileA = UploadedFile::fake()->image('image.jpg');
        $responseA = $this->from(route('contact_request.create'))
            ->post(route('contact_request.store'), $this->validData([
                'file' => $fileA,
            ]));

        $fileB = UploadedFile::fake()->image('image.png');
        $responseB = $this->from(route('contact_request.create'))
            ->post(route('contact_request.store'), $this->validData([
                'file' => $fileB,
            ]));

        $fileC = UploadedFile::fake()->image('image.gif');
        $responseC = $this->from(route('contact_request.create'))
            ->post(route('contact_request.store'), $this->validData([
                'file' => $fileC,
            ]));

        $fileD = UploadedFile::fake()->create('file.pdf', 4);
        $responseD = $this->from(route('contact_request.create'))
            ->post(route('contact_request.store'), $this->validData([
                'file' => $fileD,
            ]));

        $fileE = UploadedFile::fake()->create('word.doc', 4);
        $responseE = $this->from(route('contact_request.create'))
            ->post(route('contact_request.store'), $this->validData([
                'file' => $fileE,
            ]));

        $fileF = UploadedFile::fake()->create('word.docx', 4);
        $responseF = $this->from(route('contact_request.create'))
            ->post(route('contact_request.store'), $this->validData([
                'file' => $fileF,
            ]));

        $responseA->assertStatus(200);
        $responseB->assertStatus(200);
        $responseC->assertStatus(200);
        $responseD->assertStatus(200);
        $responseE->assertStatus(200);
        $responseF->assertStatus(200);
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