<?php

namespace Tests\Feature\ContactForm;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CreateContactFormTest
 * @package Tests\Feature
 */
class CreateContactFormTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function we_can_view_the_return_request_form()
    {
        $response = $this->get(route('contact_request.create'));

        $response->assertStatus(200);
        $response->assertViewIs('contact_request.create');
    }
}