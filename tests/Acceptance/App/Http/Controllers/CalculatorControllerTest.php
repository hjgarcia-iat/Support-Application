<?php

namespace Tests\Acceptance\App\Http\Controllers;

use App\Services\CrmInterface;
use App\Services\CrmSalesforce;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CalculatorControllerTest
 * @package Tests\Feature
 */
class CalculatorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_we_can_view_the_form()
    {
        $response = $this->get(route("calculator.show"));

        $response->assertStatus(200);
        $response->assertViewIs("calculator.show");
    }

    public function test_we_can_submit_the_results_of_the_calculator()
    {
        $this->app->instance(CrmInterface::class, new CrmSalesforce());



        $data = [
            'first_name' => 'Jane',
            'last_name'  => 'Doe',
            'email'      => 'jdoe@email.com',
            'phone'      => '000-0000-0000',
            'role'       => 'Classroom Teacher',
            'school'     => 'school',
            'city'       => 'city',
            'state'      => 'AA',
        ];

        $response = $this->post(route('calculator.store'), $data);

        //get the record
        $record = resolve(CrmInterface::class)->findByEmail($data['email']);

        $this->assertEquals($record['FirstName'], $data['first_name']);
        $this->assertEquals($record['LastName'], $data['last_name']);
        $this->assertEquals($record['Email'], $data['email']);
        $this->assertEquals($record['Phone'], $data['phone']);
        $this->assertEquals($record['Role__c'], $data['role']);
        $this->assertEquals($record['Company'], $data['school']);
        $this->assertEquals($record['City'], $data['city']);
        $this->assertEquals($record['State'], $data['state']);
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true
        ]);

        //delete the record
        resolve(CrmInterface::class)->delete($data['email']);
    }
}