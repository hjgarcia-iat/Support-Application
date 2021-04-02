<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;

/**
 * Class RequestProductInformationControllerTest
 * @package Tests\Feature
 */
class RequestProductInformationControllerTest extends TestCase
{

    public function test_we_can_view_the_form()
    {
        $response = $this->get(route("request_product_info.create"));

        $response->assertStatus(200);
        $response->assertViewIs("request_product_info.create");
    }


}