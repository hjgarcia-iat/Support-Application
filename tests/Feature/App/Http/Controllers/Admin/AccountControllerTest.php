<?php

namespace Tests\Feature\App\Http\Controllers\Admin;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class AccountControllerTest
 * @package Tests\Feature
 */
class AccountControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_we_can_see_the_account_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("admin.account.edit"));

        $response->assertStatus(200);
        $response->assertViewIs("admin.account.edit");
    }

    public function test_we_cannot_see_the_dashboard_page_if_we_are_not_authenticated()
    {
        $this->get(route("dashboard"))->assertRedirect(route('login'));
    }

}