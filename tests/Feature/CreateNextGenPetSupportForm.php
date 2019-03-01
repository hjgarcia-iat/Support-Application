<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Class CreateNextGenPetSupportForm
 * @package Tests\Feature
 */
class CreateNextGenPetSupportForm extends TestCase
{
    /**
     * @test
     */
    public function we_can_see_the_access_request_form_page()
    {
        $response = $this->get(route('nextgen_pet.create'));

        $response->assertStatus(200)
            ->assertViewIs('nextgen_pet_request.create');
    }
}