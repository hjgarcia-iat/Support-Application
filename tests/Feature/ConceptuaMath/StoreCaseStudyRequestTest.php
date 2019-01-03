<?php

namespace Tests\Feature\ConceptuaMath;

use Tests\TestCase;
use App\Services\FakeCRM;
use App\Services\CRMInterface;
use Spinen\MailAssertions\MailTracking;

class StoreCaseStudentRequestTest extends TestCase
{
    use MailTracking;

    /**
     * @var FakeCRM
     */
    public $salesforce;

    protected function setUp()
    {
        parent::setUp();
        $this->salesforce = new FakeCRM();
        $this->app->instance(CRMInterface::class, $this->salesforce);
    }

    public function test_we_can_send_a_case_study_request()
    {
        $response = $this->json('post', route('conceptua.request_case.store'), $this->validParams());

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Your message was sent.']);

        $this->seeEmailWasSent()->seeEmailTo($this->validParams()['email']);
    }

    /**
     * @test
     */
    public function the_first_name_field_is_required()
    {
        $response = $this->json('post', route('conceptua.request_case.store'), $this->validParams([
            'first_name' => ''
        ]));

        $response->assertStatus(422);
        $response->assertJsonFragment(['first_name']);
    }

    /**
     * @test
     */
    public function the_last_name_field_is_required()
    {
        $response = $this->json('post', route('conceptua.request_case.store'), $this->validParams([
            'last_name' => ''
        ]));

        $response->assertStatus(422);
        $response->assertJsonFragment(['last_name']);
    }

    /**
     * @test
     */
    public function the_email_field_is_required()
    {
        $response = $this->json('post', route('conceptua.request_case.store'), $this->validParams([
            'email' => ''
        ]));

        $response->assertStatus(422);
        $response->assertJsonFragment(['email']);
    }

    /**
     * @test
     */
    public function the_email_field_is_valid()
    {
        $response = $this->json('post', route('conceptua.request_case.store'), $this->validParams([
            'email' => 'invalid-email'
        ]));

        $response->assertStatus(422);
        $response->assertJsonFragment(['email']);
    }

    /**
     * @test
     */
    public function the_title_field_is_required()
    {
        $response = $this->json('post', route('conceptua.request_case.store'), $this->validParams([
            'title' => ''
        ]));

        $response->assertStatus(422);
        $response->assertJsonFragment(['title']);
    }

    /**
     * @test
     */
    public function the_company_field_is_valid()
    {
        $response = $this->json('post', route('conceptua.request_case.store'), $this->validParams([
            'company' => ''
        ]));

        $response->assertStatus(422);
        $response->assertJsonFragment(['company']);
    }

    /**
     * @test
     */
    public function the_city_field_is_valid()
    {
        $response = $this->json('post', route('conceptua.request_case.store'), $this->validParams([
            'city' => ''
        ]));

        $response->assertStatus(422);
        $response->assertJsonFragment(['city']);
    }

    /**
     * @test
     */
    public function the_state_field_is_valid()
    {
        $response = $this->json('post', route('conceptua.request_case.store'), $this->validParams([
            'state' => ''
        ]));

        $response->assertStatus(422);
        $response->assertJsonFragment(['state']);
    }

    /**
     * Valid form params
     *
     * @param array $overrides
     * @return array
     */
    private function validParams($overrides = [])
    {
        return array_merge([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'jdoe@email.com',
            'title' => 'Teacher Title',
            'company' => 'Some School',
            'city' => 'City',
            'state' => 'State',
        ], $overrides);
    }
}
