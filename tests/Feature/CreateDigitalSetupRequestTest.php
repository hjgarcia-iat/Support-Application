<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Class CreateDigitalSetupRequestTest
 * @package Tests\Feature
 */
class CreateDigitalSetupRequestTest extends TestCase
{
    /**
     * @test
     */
    public function we_can_see_the_digital_setup_request_page()
    {
        $this->get(route('digital_setup_request.create'))
            ->assertStatus(200)
            ->assertViewIs('digital_setup_request.create');
    }
}