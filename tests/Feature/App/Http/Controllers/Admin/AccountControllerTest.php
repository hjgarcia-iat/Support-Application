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

    public function test_we_can_see_the_account_edit_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("admin.account.edit"));

        $response->assertStatus(200);
        $response->assertViewIs("admin.account.edit");
    }

    public function test_we_can_update_an_account()
    {
        $user = User::factory()->create();
        $data = [
            'name' => 'Jane Doe',
            'email' => 'jdoe@email.com',
            'password' => 'new_password',
        ];

        $response = $this->actingAs($user)
            ->from(route('admin.account.edit'))
            ->post(route("admin.account.update"), $data);

        $response->assertRedirect(route('admin.account.edit'));
        $this->assertTrue(\Hash::check($data['password'], $user->fresh()->password));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }

    public function test_we_cannot_see_account_edit_page_if_we_are_not_authenticated()
    {
        $this->get(route("admin.account.edit"))->assertRedirect(route('login'));
    }

}