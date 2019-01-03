<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Class CreateReturnRequestFormTest
 * @package Tests\Feature
 */
class CreateReturnRequestFormTest extends TestCase
{
    /**
     * @test
     */
    public function we_can_view_the_return_request_form()
    {
        $response = $this->get(route('return_request.create'));

        $response->assertStatus(200);
        $response->assertViewIs('return_request.create');
    }
}