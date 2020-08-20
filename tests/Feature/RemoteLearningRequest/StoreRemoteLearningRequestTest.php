<?php

namespace Tests\Feature\RemoteLearningRequest;

use Carbon\Carbon;
use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;

/**
 * Class StoreRemoteLearningRequestTest
 * @package Tests\Feature
 */
class StoreRemoteLearningRequestTest extends TestCase
{
    use MailTracking;

    /**
     * @test
     */
    public function we_can_submit_the_remote_learning_request_form()
    {
        $response = $this->withoutExceptionHandling()
            ->from(route('remote_learning_request.create'))
            ->post(route('remote_learning_request.store'), $this->validData());

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Your message was sent!']);

        $this->seeEmailWasSent();
        $this->seeEmailTo(env('REMOTE_SETUP_REQUEST'));
        $this->seeEmailFrom($this->validData()['email']);
        $this->seeEmailSubjectContains('Remote Learning Request');
        $this->seeEmailContains($this->validData()['name']);
        $this->seeEmailContains($this->validData()['email']);
        $this->seeEmailContains($this->validData()['school']);
        $this->seeEmailContains($this->validData()['district']);
        $this->seeEmailContains($this->validData()['state']);
        $this->seeEmailContains($this->validData()['units'][0]);
        $this->seeEmailContains($this->validData()['units'][1]);
        $this->seeEmailContains($this->validData()['units'][2]);
    }

    /**
     * @test
     */
    public function the_name_field_is_required()
    {
        $response = $this->from(route('remote_learning_request.create'))
            ->post(route('remote_learning_request.store'), $this->validData(['name' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('remote_learning_request.create'));
        $response->assertSessionHasErrors('name');
        $this->seeEmailWasNotSent();
    }

    public function test_email_field_is_required()
    {
        $response = $this->from(route('remote_learning_request.create'))
            ->post(route('remote_learning_request.store'), $this->validData(['email' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('remote_learning_request.create'));
        $response->assertSessionHasErrors('email');
        $this->seeEmailWasNotSent();
    }

    public function test_email_field_is_valid()
    {
        $response = $this->from(route('remote_learning_request.create'))
            ->post(route('remote_learning_request.store'), $this->validData(['email' => 'invalid-email']));

        $response->assertStatus(302);
        $response->assertRedirect(route('remote_learning_request.create'));
        $response->assertSessionHasErrors('email');
        $this->seeEmailWasNotSent();
    }


    public function test_the_school_field_is_required()
    {
        $response = $this->from(route('remote_learning_request.create'))
            ->post(route('remote_learning_request.store'), $this->validData(['school' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('remote_learning_request.create'));
        $response->assertSessionHasErrors('school');
        $this->seeEmailWasNotSent();
    }

    public function test_the_district_field_is_required()
    {
        $response = $this->from(route('remote_learning_request.create'))
            ->post(route('remote_learning_request.store'), $this->validData(['district' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('remote_learning_request.create'));
        $response->assertSessionHasErrors('district');
        $this->seeEmailWasNotSent();
    }

    public function test_the_state_field_is_required()
    {
        $response = $this->from(route('remote_learning_request.create'))
            ->post(route('remote_learning_request.store'), $this->validData(['state' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('remote_learning_request.create'));
        $response->assertSessionHasErrors('state');
        $this->seeEmailWasNotSent();
    }

    public function test_the_units_field_is_required()
    {
        $response = $this->from(route('remote_learning_request.create'))
            ->post(route('remote_learning_request.store'), $this->validData(['units' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('remote_learning_request.create'));
        $response->assertSessionHasErrors('units');
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
            'name' => 'Jeff Doe',
            'email' => 'jeffdoe@email.com',
            'district' => 'Some District',
            'school' => 'Some School',
            'state' => 'NY',
            'units' => ['PS1','PS2','PS3']
        ], $overrides);
    }
}