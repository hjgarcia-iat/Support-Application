<?php

namespace Tests\Feature;

use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;

/**
 * Class StoreNextGenPetRequestTest
 * @package Tests\Feature
 */
class StoreNextGenPetRequestTest extends TestCase
{
    use MailTracking;

    public function test_we_can_send_an_email_when_the_nextgen_pet_request_form_is_submitted()
    {
        $response = $this->post(route('nextgen_pet.store'), $this->validParams());

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Your message was sent!']);
        $this->seeEmailWasSent();
        $this->seeEmailTo(env('DESK_SUPPORT_EMAIL'));
        $this->seeEmailTo(env('FULFILLMENT_EMAIL'));
        $this->seeEmailFrom($this->validParams()['email']);
        $this->seeEmailContains($this->validParams()['institution_name']);
        $this->seeEmailContains($this->validParams()['name']);
        $this->seeEmailContains($this->validParams()['email']);
        $this->seeEmailContains($this->validParams()['po_number']);
        $this->seeEmailContains($this->validParams()['inquiry']);
        $this->seeEmailContains($this->validParams()['comment']);
    }

    public function test_we_can_send_an_email_when_the_nextgen_pet_request_form_is_submitted_but_the_comment_field_is_empty()
    {
        $response = $this->post(route('nextgen_pet.store'), $this->validParams(['comment' => '']));

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Your message was sent!']);
        $this->seeEmailWasSent();
        $this->seeEmailTo(env('DESK_SUPPORT_EMAIL'));
        $this->seeEmailFrom($this->validParams()['email']);
        $this->seeEmailContains($this->validParams()['institution_name']);
        $this->seeEmailContains($this->validParams()['name']);
        $this->seeEmailContains($this->validParams()['email']);
        $this->seeEmailContains($this->validParams()['po_number']);
        $this->seeEmailContains($this->validParams()['inquiry']);
    }

    public function test_the_instution_name_field_is_required()
    {
        $response = $this->from(route('nextgen_pet.create'))
            ->post(route('nextgen_pet.store'), $this->validParams(['institution_name' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('nextgen_pet.create'));
        $response->assertSessionHasErrors('institution_name');
        $this->seeEmailWasNotSent();
    }

    public function test_the_name_field_is_required()
    {
        $response = $this->from(route('nextgen_pet.create'))
            ->post(route('nextgen_pet.store'), $this->validParams(['name' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('nextgen_pet.create'));
        $response->assertSessionHasErrors('name');
        $this->seeEmailWasNotSent();
    }

    public function test_the_email_field_is_required()
    {
        $response = $this->from(route('nextgen_pet.create'))
            ->post(route('nextgen_pet.store'), $this->validParams(['email' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('nextgen_pet.create'));
        $response->assertSessionHasErrors('email');
        $this->seeEmailWasNotSent();
    }

    public function test_the_email_field_is_valid()
    {
        $response = $this->from(route('nextgen_pet.create'))
            ->post(route('nextgen_pet.store'), $this->validParams(['email' => 'invalid-email']));

        $response->assertStatus(302);
        $response->assertRedirect(route('nextgen_pet.create'));
        $response->assertSessionHasErrors('email');
        $this->seeEmailWasNotSent();
    }

    public function test_the_po_number_field_is_required()
    {
        $response = $this->from(route('nextgen_pet.create'))
            ->post(route('nextgen_pet.store'), $this->validParams(['po_number' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('nextgen_pet.create'));
        $response->assertSessionHasErrors('po_number');
        $this->seeEmailWasNotSent();
    }

    public function test_the_inquiry_field_is_required()
    {
        $response = $this->from(route('nextgen_pet.create'))
            ->post(route('nextgen_pet.store'), $this->validParams(['inquiry' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('nextgen_pet.create'));
        $response->assertSessionHasErrors('inquiry');
        $this->seeEmailWasNotSent();
    }

    public function test_the_comment_field_is_required_if_inquiry_is_other()
    {
        $response = $this->from(route('nextgen_pet.create'))
            ->post(route('nextgen_pet.store'), $this->validParams(['inquiry' => 'other', 'comment' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('nextgen_pet.create'));
        $response->assertSessionHasErrors('comment');
        $this->seeEmailWasNotSent();
    }

    public function test_the_comment_field_is_required_if_inquiry_is_order_cancellation()
    {
        $response = $this->from(route('nextgen_pet.create'))
            ->post(route('nextgen_pet.store'), $this->validParams(['inquiry' => 'order_cancellation', 'comment' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('nextgen_pet.create'));
        $response->assertSessionHasErrors('comment');
        $this->seeEmailWasNotSent();
    }

    public function test_the_comment_field_is_required_if_inquiry_is_order_modification()
    {
        $response = $this->from(route('nextgen_pet.create'))
            ->post(route('nextgen_pet.store'), $this->validParams(['inquiry' => 'order_modification', 'comment' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('nextgen_pet.create'));
        $response->assertSessionHasErrors('comment');
        $this->seeEmailWasNotSent();
    }


    /**
     * Return valid form paramaters
     *
     * @param array $params
     * @return array
     */
    private function validParams($params = [])
    {
        return array_merge([
            'institution_name' => 'Some College',
            'name' => 'Jane Doe',
            'email' => 'jdoe@email.com',
            'po_number' => '1243',
            'inquiry' => 'inquiry',
            'comment' => 'Some Comment',
        ], $params);
    }
}