<?php

namespace Tests\Feature\ConceptuaMath;

use Tests\TestCase;

class CreateCaseStudyRequestTest extends TestCase
{
    /**
     * @test
     */
    public function we_can_see_the_case_study_form_page()
    {
        $response = $this->get(route('conceptua.request_case.create'));

        $response->assertStatus(200);
        $response->assertViewIs('conceptua.request_case.create');
    }
}