<?php

namespace Tests\Feature\ConceptuaMath;

use Tests\TestCase;

class CreateRequestAQuoteTest extends TestCase
{
    /**
     * @test
     */
    public function we_can_see_the_request_a_sample_page()
    {
        $response = $this->get(route('conceptua.request_quote.create'));
        
        $response->assertStatus(200);
        $response->assertViewIs('conceptua.request_quote.create');
    }
}
