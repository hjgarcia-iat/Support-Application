<?php

namespace Tests\Acceptance;

use Tests\TestCase;
use App\Services\FakeCRM;
use App\Services\CRMInterface;
use Spinen\MailAssertions\MailTracking;

/**
 * Class StoreCaseStudentRequestTest
 * @package Tests\Acceptance
 */
class StoreCaseStudentRequestTest extends TestCase
{
    use MailTracking;

    public function test_we_can_send_a_case_study_request()
    {
        $response = $this->json('post', route('conceptua.request_case.store'), $this->validParams());

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Your message was sent.']);

        $this->seeEmailWasSent()->seeEmailTo($this->validParams()['email']);
        $this->assertEquals($this->validParams()['email'], \Salesforce::query("SELECT Id,Email from Lead WHERE email='" . $this->validParams()['email'] . "'")->records[0]->Email);
    }

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
            'last_name' => 'Doe',
            'email' => 'email@email.com',
            'company' => 'School ABC',
            'city' => 'Some City',
            'state' => 'NY',
            'title' => 'Teacher Title',
        ], $overrides);
    }
}
