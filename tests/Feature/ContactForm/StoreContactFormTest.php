<?php

namespace Tests\Feature\ContactForm;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;

/**
 * Class StoreContactFormTest
 * @package Tests\Feature
 */
class StoreContactFormTest extends TestCase
{
    use MailTracking, RefreshDatabase;

    public function test_the_contact_form_can_submit()
    {
        $response = $this->from(route('contact_request.create'))
            ->post(route('contact_request.store'), $this->validData());

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->seeEmailWasSent();
        $this->seeEmailSubjectEquals("[". $this->validData()['reason'] ."]" . $this->validData()['subject']);
        $this->seeEmailContains($this->validData()['reason']);
        $this->seeEmailContains($this->validData()['name']);
        $this->seeEmailContains($this->validData()['email']);
        $this->seeEmailContains($this->validData()['district']);
        $this->seeEmailContains($this->validData()['details']);
    }

    public function test_the_reason_field_is_required()
    {
        $response = $this->from(route('contact_request.create'))
            ->post(route('contact_request.store'), $this->validData(['reason' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('contact_request.create'));
        $response->assertSessionHasErrors('reason');
        $this->seeEmailWasNotSent();
    }

    public function test_the_name_field_is_required()
    {
        $response = $this->from(route('contact_request.create'))
            ->post(route('contact_request.store'), $this->validData(['name' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('contact_request.create'));
        $response->assertSessionHasErrors('name');
        $this->seeEmailWasNotSent();
    }

    public function test_the_email_field_is_required()
    {
        $response = $this->from(route('contact_request.create'))
            ->post(route('contact_request.store'), $this->validData(['email' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('contact_request.create'));
        $response->assertSessionHasErrors('email');
        $this->seeEmailWasNotSent();
    }

    public function test_the_email_field_is_valid()
    {
        $response = $this->from(route('contact_request.create'))
            ->post(route('contact_request.store'), $this->validData(['email' => 'invalid-email']));

        $response->assertStatus(302);
        $response->assertRedirect(route('contact_request.create'));
        $response->assertSessionHasErrors('email');
        $this->seeEmailWasNotSent();
    }

    public function test_the_district_field_is_required()
    {
        $response = $this->from(route('contact_request.create'))
            ->post(route('contact_request.store'), $this->validData(['district' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('contact_request.create'));
        $response->assertSessionHasErrors('district');
        $this->seeEmailWasNotSent();
    }

    public function test_the_subject_field_is_required()
    {
        $response = $this->from(route('contact_request.create'))
            ->post(route('contact_request.store'), $this->validData(['subject' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('contact_request.create'));
        $response->assertSessionHasErrors('subject');
        $this->seeEmailWasNotSent();
    }

    public function test_the_details_field_is_required()
    {
        $response = $this->from(route('contact_request.create'))
            ->post(route('contact_request.store'), $this->validData(['details' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('contact_request.create'));
        $response->assertSessionHasErrors('details');
        $this->seeEmailWasNotSent();
    }

    /**
     * Get valid form data
     *
     * @param array $overrides
     * @return array
     */
    private function validData($overrides = [])
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