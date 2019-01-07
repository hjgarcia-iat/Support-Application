<?php

namespace Tests\Acceptance;

use Tests\TestCase;
use App\Services\FakeCRM;
use App\Services\CRMInterface;
use Spinen\MailAssertions\MailTracking;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class StoreRequestAQuoteTest
 * @package Tests\Acceptance
 */
class StoreRequestAQuoteTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions, MailTracking;

    /**
     * @test
     */
    public function we_can_store_conceptua_demo_request()
    {
        $response = $this->from(route('conceptua.request_quote.create'))
            ->post(route('conceptua.request_quote.store'), $this->validParams());

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Your message was sent.']);

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
     * @param array $overrides
     * @return array
     */
    private function validParams($overrides = [])
    {
        return array_merge([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'email@email.com',
            'company' => 'School ABC',
            'title' => 'Teacher Title',
            'license' => 'The License',
            'city' => 'Some City',
            'state' => 'NY',
        ], $overrides);
    }
}
