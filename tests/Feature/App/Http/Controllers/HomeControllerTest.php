<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;

/**
 * Class HomeControllerTest
 * @package Tests\Feature
 */
class HomeControllerTest extends TestCase
{

    public function test_we_can_see_the_home_page()
    {
        $this->get(route('home'))
             ->assertStatus(200)
             ->assertViewIs('home.index');
    }
}
