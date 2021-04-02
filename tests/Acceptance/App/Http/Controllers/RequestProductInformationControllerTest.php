<?php

namespace Tests\Acceptance\App\Http\Controllers;

use App\Services\CrmInterface;
use App\Services\CrmSalesforce;
use Tests\TestCase;

/**
 * Class RequestProductInformationControllerTest
 * @package Tests\Feature
 */
class RequestProductInformationControllerTest extends TestCase
{
    public function test_we_can_submit_the_request_product_information_form()
    {
        $this->app->instance(CrmInterface::class, new CrmSalesforce());
        $data = [
            'first_name'       => 'Jane',
            'last_name'        => 'Doe',
            'email'            => 'email@email.com',
            'phone'            => '000-0000-0000',
            'role'             => 'Classroom Teacher',
            'school'           => 'school',
            'district'         => 'district',
            'city'             => 'city',
            'state'            => 'AA',
            'product_interest' => 'Product',
        ];

        $response = $this->post(route('request_product_info.store'), $data);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $record = resolve(CrmInterface::class)->findByEmail($data['email']);

        $this->assertEquals($record['FirstName'], $data['first_name']);
        $this->assertEquals($record['LastName'], $data['last_name']);
        $this->assertEquals($record['Email'], $data['email']);
        $this->assertEquals($record['Phone'], $data['phone']);
        $this->assertEquals($record['Role__c'], $data['role']);
        $this->assertEquals($record['Company'], $data['school']);
        $this->assertEquals($record['District_Name__c'], $data['district']);
        $this->assertEquals($record['City'], $data['city']);
        $this->assertEquals($record['State'], $data['state']);
        $this->assertEquals($record['Product_Interest__c'], $data['product_interest']);
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        //delete the record
        resolve(CrmInterface::class)->delete($data['email']);
    }
}