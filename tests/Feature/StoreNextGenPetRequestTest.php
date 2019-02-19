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