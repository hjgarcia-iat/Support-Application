<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Services\CrmInterface;
use Tests\TestCase;

/**
 * Class RequestProductInformationControllerTest
 * @package Tests\Feature
 */
class RequestProductInformationControllerTest extends TestCase
{
    public function test_we_can_view_the_request_product_information_form()
    {
        $response = $this->get(route("request_product_info.create"));

        $response->assertStatus(200);
        $response->assertViewIs("request_product_info.create");
    }

    public function test_we_can_submit_the_request_product_information_form()
    {
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
        $this->assertEquals(resolve(CrmInterface::class)->findByEmail($data['email']), $data);
    }
}