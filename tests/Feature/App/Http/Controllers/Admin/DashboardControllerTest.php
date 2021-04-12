<?php

namespace Tests\Feature\App\Http\Controllers\Admin;

use App\Services\CrmInterface;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class DashboardControllerTest
 * @package Tests\Feature
 */
class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_we_can_see_the_dashboard_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("dashboard"));

        $response->assertStatus(200);
        $response->assertViewIs("admin.dashboard.index");
    }

    public function test_we_cannot_see_the_dashboard_page_if_we_are_not_authenticated()
    {
        $this->get(route("dashboard"))->assertRedirect(route('login'));
    }

}