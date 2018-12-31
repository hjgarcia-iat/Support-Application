<?php

namespace Tests\Feature\ConceptuaMath;

use App\Services\CRMInterface;
use App\Services\FakeCRM;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;

/**
 * Class StoreRequestADemoTest
 * @package Tests\Feature\ConceptuaMath
 */
class StoreRequestADemoTest extends TestCase
{
    use MailTracking, DatabaseTransactions, DatabaseMigrations;

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

    public function test_we_can_store_conceptua_demo_request()
    {
        $response = $this->from(route('conceptua.request_demo.create'))
            ->post(route('conceptua.request_demo.store'), $this->validParams());

        $response->assertStatus(200);
        $response->assertJson(['message' => 'The request was sent!']);

        $this->seeEmailWasSent();
        $this->seeEmailTo($this->validParams()['email']);
        $this->seeEmailContains($this->validParams()['first_name']);
    }


    /**
     * @test
     */
    public function the_first_name_field_is_required()
    {
        $response = $this->from(route('conceptua.request_demo.create'))
            ->post(route('conceptua.request_demo.store'), $this->validParams(['first_name' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('conceptua.request_demo.create'));
        $response->assertSessionHasErrors('first_name');
    }


    /**
     * @test
     */
    public function the_last_name_field_is_required()
    {
        $response = $this->from(route('conceptua.request_demo.create'))
            ->post(route('conceptua.request_demo.store'), $this->validParams(['last_name' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('conceptua.request_demo.create'));
        $response->assertSessionHasErrors('last_name');
    }

    /**
     * @test
     */
    public function the_email_field_is_required()
    {
        $response = $this->from(route('conceptua.request_demo.create'))
            ->post(route('conceptua.request_demo.store'), $this->validParams(['email' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('conceptua.request_demo.create'));
        $response->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function the_email_field_is_valid()
    {
        $response = $this->from(route('conceptua.request_demo.create'))
            ->post(route('conceptua.request_demo.store'), $this->validParams(['email' => 'invalid-email']));

        $response->assertStatus(302);
        $response->assertRedirect(route('conceptua.request_demo.create'));
        $response->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function the_title_field_is_required()
    {
        $response = $this->from(route('conceptua.request_demo.create'))
            ->post(route('conceptua.request_demo.store'), $this->validParams(['title' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('conceptua.request_demo.create'));
        $response->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function the_company_field_is_valid()
    {
        $response = $this->from(route('conceptua.request_demo.create'))
            ->post(route('conceptua.request_demo.store'), $this->validParams(['company' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('conceptua.request_demo.create'));
        $response->assertSessionHasErrors('company');
    }

    /**
     * @test
     */
    public function the_city_field_is_required()
    {
        $response = $this->from(route('conceptua.request_demo.create'))
            ->post(route('conceptua.request_demo.store'), $this->validParams(['city' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('conceptua.request_demo.create'));
        $response->assertSessionHasErrors('city');
    }

    /**
     * @test
     */
    public function the_state_field_is_required()
    {
        $response = $this->from(route('conceptua.request_demo.create'))
            ->post(route('conceptua.request_demo.store'), $this->validParams(['state' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('conceptua.request_demo.create'));
        $response->assertSessionHasErrors('state');
    }
    /**
     * @param array $overrides
     * @return array
     */
    private function validParams($overrides = [])
    {
        return array_merge([
            'first_name' => 'Jane',
            'last_name'  => 'Doe',
            'email'      => 'email@email.com',
            'company'    => 'School ABC',
            'city'    => 'Some City',
            'state'    => 'Some State',
            'title' => 'Teacher Title',
        ], $overrides);
    }
}