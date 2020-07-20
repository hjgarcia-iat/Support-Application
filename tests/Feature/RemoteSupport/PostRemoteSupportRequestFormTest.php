<?php

namespace Tests\RemoteSupport\Feature;

use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;

/**
 * Class PostRemoteSupportRequestFormTest
 * @package Tests\Feature
 */
class PostRemoteSupportRequestFormTest extends TestCase
{
    use MailTracking;

    public function test_we_can_send_an_email_when_the_remote_support_create_form_is_submitted()
    {
        $response = $this->post(route('remote_support.store'), $this->validData());

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Your message was sent!']);
        $this->seeEmailWasSent();
        $this->seeEmailTo(env('DESK_SUPPORT_EMAIL'));
        $this->seeEmailFrom($this->validData()['email']);
        $this->seeEmailContains($this->validData()['subject']);
        $this->seeEmailContains($this->validData()['name']);
        $this->seeEmailContains($this->validData()['email']);
        $this->seeEmailContains($this->validData()['student_name']);
        $this->seeEmailContains($this->validData()['teacher_name']);
        $this->seeEmailContains($this->validData()['district']);
        $this->seeEmailContains($this->validData()['state']);
        $this->seeEmailContains($this->validData()['comment']);
    }


    public function test_the_name_field_is_required()
    {
        $response = $this->from(route('remote_support.create'))
            ->post(route('remote_support.store'), $this->validData([
                'name' => '',
            ]));

        $response->assertStatus(302);
        $response->assertRedirect(route('remote_support.create'));
        $response->assertSessionHasErrors('name');
        $this->seeEmailWasNotSent();
    }


    public function test_the_email_field_is_required()
    {
        $response = $this->from(route('remote_support.create'))
            ->post(route('remote_support.store'), $this->validData([
                'email' => '',
            ]));

        $response->assertStatus(302);
        $response->assertRedirect(route('remote_support.create'));
        $response->assertSessionHasErrors('email');
        $this->seeEmailWasNotSent();
    }

    public function test_the_email_field_is_valid()
    {
        $response = $this->from(route('remote_support.create'))
            ->post(route('remote_support.store'), $this->validData([
                'email' => 'invalid-email',
            ]));

        $response->assertStatus(302);
        $response->assertRedirect(route('remote_support.create'));
        $response->assertSessionHasErrors('email');
        $this->seeEmailWasNotSent();
    }


    public function test_the_student_name_field_is_required()
    {
        $response = $this->from(route('remote_support.create'))
            ->post(route('remote_support.store'), $this->validData([
                'student_name' => '',
            ]));

        $response->assertStatus(302);
        $response->assertRedirect(route('remote_support.create'));
        $response->assertSessionHasErrors('student_name');
        $this->seeEmailWasNotSent();
    }

    public function test_the_teacher_name_field_is_required()
    {
        $response = $this->from(route('remote_support.create'))
            ->post(route('remote_support.store'), $this->validData([
                'teacher_name' => '',
            ]));

        $response->assertStatus(302);
        $response->assertRedirect(route('remote_support.create'));
        $response->assertSessionHasErrors('teacher_name');
        $this->seeEmailWasNotSent();
    }

    public function test_the_district_field_is_required()
    {
        $response = $this->from(route('remote_support.create'))
            ->post(route('remote_support.store'), $this->validData([
                'district' => '',
            ]));

        $response->assertStatus(302);
        $response->assertRedirect(route('remote_support.create'));
        $response->assertSessionHasErrors('district');
        $this->seeEmailWasNotSent();
    }

    public function test_the_state_field_is_required()
    {
        $response = $this->from(route('remote_support.create'))
            ->post(route('remote_support.store'), $this->validData([
                'state' => '',
            ]));

        $response->assertStatus(302);
        $response->assertRedirect(route('remote_support.create'));
        $response->assertSessionHasErrors('state');
        $this->seeEmailWasNotSent();
    }

    public function test_the_comment_field_is_required()
    {
        $response = $this->from(route('remote_support.create'))
            ->post(route('remote_support.store'), $this->validData([
                'comment' => '',
            ]));

        $response->assertStatus(302);
        $response->assertRedirect(route('remote_support.create'));
        $response->assertSessionHasErrors('comment');
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
            'name' => 'John Doe',
            'email' => 'email@email.com',
            'student_name' => 'Jane Doe',
            'teacher_name' => 'Teacher',
            'district' => 'District',
            'state' => 'state',
            'subject' => 'Test',
            'comment' => 'comment'
        ], $overrides);
    }
}