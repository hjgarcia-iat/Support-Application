<?php

namespace Tests\Feature\AccessRequest;

use Tests\TestCase;

/**
 * Class CreateAccessRequestForm
 * @package Tests\Feature
 */
class CreateAccessRequestFormTest extends TestCase
{
    /**
     * @test
     */
    public function we_can_see_the_access_request_form_page()
    {
        $this->get(route('access_request.create'))->assertStatus(200)->assertViewIs('access_request.create');
    }
}