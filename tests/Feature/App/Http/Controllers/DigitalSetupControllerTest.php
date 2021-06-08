<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;

class DigitalSetupControllerTest extends TestCase
{
    use RefreshDatabase, MailTracking;

    public function test_as_a_user_we_can_see_the_digital_setup_request_form()
    {
        $this->get(route('digital_setup_request.create'))
            ->assertStatus(200)
            ->assertViewIs('digital_setup_request.create');
    }

    public function test_as_a_user_we_can_send_the_digital_setup_request_form_with_it_manager_information()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData());

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Your message was sent!']);

        $this->seeEmailWasSent();
        $this->seeEmailTo(config('mail.to.support_email'));
        $this->seeEmailFrom($this->validData()['email']);
        $this->seeEmailSubjectContains('NEW ORDER - IDE setup form');
        $this->seeEmailContains($this->validData()['name']);
        $this->seeEmailContains($this->validData()['email']);
        $this->seeEmailContains($this->validData()['po_number']);
        $this->seeEmailContains($this->validData()['district']);
        $this->seeEmailContains($this->validData()['start_date']);
        $this->seeEmailContains($this->validData()['curriculum']);
        $this->seeEmailContains($this->validData()['dm_name']);
        $this->seeEmailContains($this->validData()['dm_email']);
    }

    public function test_as_a_user_we_can_send_digital_setup_information_with_teacher_information()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData([
                'district_manager' => 'no',
                'teachers'         => [
                    [
                        'name'   => 'Jane Doe',
                        'email'  => 'email@email.com',
                        'school' => 'school',
                    ],
                ],
            ]));

        $response->assertStatus(200);
        $response->assertJson(['success' => 'Your message was sent!']);

        $this->seeEmailWasSent();
        $this->seeEmailTo(config('mail.to.support_email'));
        $this->seeEmailSubjectContains('NEW ORDER - IDE setup form');
        $this->seeEmailFrom($this->validData()['email']);
        $this->seeEmailContains($this->validData()['name']);
        $this->seeEmailContains($this->validData()['email']);
        $this->seeEmailContains($this->validData()['po_number']);
        $this->seeEmailContains($this->validData()['district']);
        $this->seeEmailContains($this->validData()['start_date']);
        $this->seeEmailContains($this->validData()['curriculum']);
        $this->seeEmailContains('Jane Doe');
        $this->seeEmailContains('email@email.com');
        $this->seeEmailContains('school');
    }

    public function test_the_name_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['name' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('name');
        $this->seeEmailWasNotSent();
    }

    public function test_email_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['email' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('email');
        $this->seeEmailWasNotSent();
    }

    public function test_email_field_is_valid()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['email' => 'invalid-email']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('email');
        $this->seeEmailWasNotSent();
    }

    public function test_the_po_number_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['po_number' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('po_number');
        $this->seeEmailWasNotSent();
    }

    public function test_the_district_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('district');
        $this->seeEmailWasNotSent();
    }

    public function test_the_start_date_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['start_date' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('start_date');
        $this->seeEmailWasNotSent();
    }

    public function test_the_curriculum_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['curriculum' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('curriculum');
        $this->seeEmailWasNotSent();
    }

    public function test_the_district_manager_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('district_manager');
        $this->seeEmailWasNotSent();
    }

    public function test_the_that_if_district_manager_field_is_yes_then_dm_name_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => 'yes', 'dm_name' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('dm_name');
        $this->seeEmailWasNotSent();
    }

    public function test_the_that_if_district_manager_field_is_yes_then_dm_email_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => 'yes', 'dm_email' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('dm_email');
        $this->seeEmailWasNotSent();
    }

    public function test_the_that_if_district_manager_field_is_yes_then_dm_email_field_is_valid()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => 'yes', 'dm_email' => 'invalid-email']));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('dm_email');
        $this->seeEmailWasNotSent();
    }

    public function test_the_that_if_district_manager_field_is_no_the_teacher_fields_are_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => 'no', 'teachers' => []]));

        $response->assertStatus(302);

        $response->assertSessionHasErrors('teachers');
        $this->seeEmailWasNotSent();
    }

    public function test_the_that_if_district_manager_field_is_no_the_teacher_name_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => 'no', 'teachers' => [
                [
                    'name'   => '',
                    'email'  => 'email@email.com',
                    'school' => 'school',
                ],
            ]]));

        $response->assertStatus(302);

        $response->assertSessionHasErrors('teachers.*.name');
        $this->seeEmailWasNotSent();
    }


    public function test_the_that_if_district_manager_field_is_no_then_teacher_email_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => 'no', 'teachers' => [
                ['name'   => 'Jane Doe',
                    'email'  => '',
                    'school' => 'school',],
            ]]));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('teachers.*.email');
        $this->seeEmailWasNotSent();
    }

    public function test_the_that_if_district_manager_field_is_no_then_teacher_email_field_is_valid()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => 'no', 'teachers' => [
                ['name'   => 'Jane Doe',
                    'email'  => 'invalid-email',
                    'school' => 'school',],
            ]]));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('teachers.*.email');
        $this->seeEmailWasNotSent();
    }

    public function test_the_that_if_district_manager_field_is_no_then_teacher_school_field_is_required()
    {
        $response = $this->from(route('digital_setup_request.create'))
            ->post(route('digital_setup_request.store'), $this->validData(['district_manager' => 'no', 'teachers' => [
                [
                    'name'   => 'Jane Doe',
                    'email'  => 'email@email.com',
                    'school' => '',
                ],
            ]]));

        $response->assertStatus(302);
        $response->assertRedirect(route('digital_setup_request.create'));
        $response->assertSessionHasErrors('teachers.*.school');
        $this->seeEmailWasNotSent();
    }

    private function validData(array $overrides = []): array
    {
        return array_merge([
            'name'             => 'Jeff Doe',
            'email'            => 'jeffdoe@email.com',
            'po_number'        => '00000',
            'district'         => 'Some School District',
            'district_manager' => 'yes',
            'start_date'       => now()->addMonth()->format('m/d/Y'),
            'curriculum'       => 'Some Curriculum',
            'dm_name'          => 'Jane Doe',
            'dm_email'         => 'jdoe@email.com',

        ], $overrides);
    }
}
