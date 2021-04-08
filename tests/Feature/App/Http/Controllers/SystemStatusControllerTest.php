<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class SystemStatusControllerTest
 * @package Tests\Feature
 */
class SystemStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_we_can_see_the_system_status_home_page()
    {
        $response = $this->get(route('system_status.index'));

        $response->assertStatus(200);
        $response->assertViewIs('system_status.index');
    }
}