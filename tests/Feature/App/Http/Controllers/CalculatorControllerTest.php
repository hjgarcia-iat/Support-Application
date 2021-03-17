<?php

namespace Tests\App\Http\Controllers;

use App\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CalculatorControllerTest
 * @package Tests\Feature
 */
class CalculatorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_we_can_view_the_form()
    {
        $response = $this->get(route("calculator.show"));

        $response->assertStatus(200);
        $response->assertViewIs("calculator.show");
    }
}