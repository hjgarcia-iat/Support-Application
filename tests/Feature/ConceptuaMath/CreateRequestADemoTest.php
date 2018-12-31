<?php

namespace Tests\Feature\ConceptuaMath;

use Tests\TestCase;

/**
 * Class CreateRequestADemoTest
 * @package Tests\Feature\ConceptuaMath
 */
class CreateRequestADemoTest extends TestCase
{
    /**
     * @test
     */
    public function we_can_see_the_request_a_demo_form()
    {
        $response = $this->get(route('conceptua.request_demo.create'));

        $response->assertStatus(200);
        $response->assertViewIs('conceptua.request_demo.create');
    }
}