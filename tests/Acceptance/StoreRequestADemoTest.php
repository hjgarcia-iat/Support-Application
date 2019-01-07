<?php

namespace Tests\Acceptance;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;

/**
 * Class StoreRequestADemoTest
 * @package Tests\Acceptance
 */
class StoreRequestADemoTest extends TestCase
{
    use MailTracking, DatabaseTransactions, DatabaseMigrations;

    /**
     * @test
     */
    public function we_can_store_conceptua_demo_request_in_salesforce()
    {
        $response = $this->from(route('conceptua.request_demo.create'))
            ->post(route('conceptua.request_demo.store'), $this->validParams());

        $response->assertStatus(200);
        $response->assertJson(['message' => 'The request was sent!']);

        $this->seeEmailWasSent();
        $this->seeEmailTo($this->validParams()['email']);
        $this->seeEmailContains($this->validParams()['first_name']);

        $this->assertEquals($this->validParams()['email'], \Salesforce::query("SELECT Id,Email from Lead WHERE email='" . $this->validParams()['email'] . "'")->records[0]->Email);
    }

    /**
     * Tear Down
     */
    public function tearDown()
    {
        //delete the lead that was generated
        $lead = \Salesforce::query("SELECT Id from Lead WHERE email='" . $this->validParams()['email'] . "'");

        \Salesforce::delete([$lead->records[0]->Id]);

        parent::tearDown();
    }

    /**
     * Valid Data
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
            'state'    => 'NY',
            'title' => 'Teacher Title',
        ], $overrides);
    }

}