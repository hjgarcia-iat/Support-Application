<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class HomePageTest
 * @package Tests\Feature
 */
class HomePageTest extends TestCase
{

    /**
     * @test
     */
    public function when_the_home_page_loads_we_are_redirected_to_main_site()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect('https://help.activatelearning.com/s/');
    }
}
