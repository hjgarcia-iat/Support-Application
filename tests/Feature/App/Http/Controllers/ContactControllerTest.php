<?php

namespace Tests\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ContactControllerTest
 * @package Tests\Feature
 */
class ContactControllerTest extends TestCase
{
    use RefreshDatabase;


    public function test_we_can_view_the_form()
    {
        $response = $this->get(route('contact_request.create'));

        $response->assertStatus(200);
        $response->assertViewIs('contact_request.create');
    }
}