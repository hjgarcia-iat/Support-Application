<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class HomeControllerTest
 * @package Tests\Feature
 */
class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_we_can_see_the_home_page()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200)
            ->assertViewIs('home.index');
    }
}
