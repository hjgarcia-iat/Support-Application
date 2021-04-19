<?php

namespace Tests\Feature\App\Http\Controllers\Admin;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_we_can_see_all_users()
    {
        $authenticatedUser = User::factory()->create();
        $users = User::factory(4)->create();

        $response = $this->actingAs($authenticatedUser)->get(route("admin.users"));

        $response->assertStatus(200);
        $response->assertViewIs("admin.users.index");
        $this->assertFalse($response->viewData('users')->contains($authenticatedUser));
        $users->each(function ($user) use ($response) {
            $response->assertSee($user->name);
        });
    }

    public function test_we_can_create_a_user()
    {
        $authenticatedUser = User::factory()->create();

        $response = $this->actingAs($authenticatedUser)->get(route("admin.users.create"));

        $response->assertStatus(200);
        $response->assertViewIs("admin.users.create");
    }

    public function test_we_can_store_a_user()
    {
        $authenticatedUser = User::factory()->create();
        $data = [
            'name' => 'Jane Doe',
            'email' => 'jdoe@email.com',
            'password' => 'NewPassword1',
            'password_confirmation' => 'NewPassword1',
        ];

        $response = $this->actingAs($authenticatedUser)->post(route("admin.users.store",), $data);

        $response->assertRedirect(route('admin.users'));
        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
        $this->assertTrue(\Hash::check($data['password'], User::where('email', $data['email'])->first()->password));
    }

    public function test_we_can_edit_a_user()
    {
        $authenticatedUser = User::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($authenticatedUser)->get(route("admin.users.edit", $user->id));

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.edit');
        $response->assertSee($user->name);
    }

    public function test_we_cannot_see_edit_page_for_a_user_that_does_not_exist()
    {
        $authenticatedUser = User::factory()->create();

        $response = $this->actingAs($authenticatedUser)->get(route("admin.users.edit", 'does-not-exist'));

        $response->assertStatus(404);
    }

    public function test_we_can_update_a_user()
    {
        $authenticatedUser = User::factory()->create();
        $user = User::factory()->create();
        $data = [
            'name' => 'Jane Doe',
            'email' => 'jdoe@email.com',
            'password' => 'NewPassword1',
            'password_confirmation' => 'NewPassword1',
        ];

        $response = $this->actingAs($authenticatedUser)->post(route("admin.users.update", $user), $data);

        $response->assertRedirect(route('admin.users.edit', $user->id));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
        $this->assertTrue(\Hash::check($data['password'], $user->fresh()->password));
    }

    public function test_we_can_update_a_user_and_the_password_will_not_change_if_the_password_is_not_updated()
    {
        $authenticatedUser = User::factory()->create();
        $user = User::factory()->create();
        $data = [
            'name' => 'Jane Doe',
            'email' => 'jdoe@email.com',
            'password' => '',
            'password_confirmation' => '',
        ];

        $response = $this->actingAs($authenticatedUser)->post(route("admin.users.update", $user), $data);

        $response->assertRedirect(route('admin.users.edit', $user->id));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
        $this->assertTrue(\Hash::check('password', $user->fresh()->password));
    }

    public function test_we_cannot_update_a_user_that_does_not_exist()
    {
        $authenticatedUser = User::factory()->create();

        $data = [
            'name' => 'Jane Doe',
            'email' => 'jdoe@email.com',
            'password' => '',
            'password_confirmation' => '',
        ];

        $response = $this->actingAs($authenticatedUser)->post(route("admin.users.update", 'does-not-exist'), $data);

        $response->assertStatus(404);
    }

    public function test_we_can_delete_a_user()
    {
        $authenticatedUser = User::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($authenticatedUser)->get(route("admin.users.delete", $user));

        $response->assertRedirect(route('admin.users'));
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    public function test_we_cannot_delete_a_user_that_does_exist()
    {
        $authenticatedUser = User::factory()->create();

        $response = $this->actingAs($authenticatedUser)->get(route("admin.users.delete", 'does-not-exist'));

        $response->assertStatus(404);
    }

    public function test_we_need_to_be_authenticated_to_view_user_resources()
    {
        $this->get(route("admin.users"))->assertRedirect(route('login'));
        $this->get(route("admin.users.create"))->assertRedirect(route('login'));
        $this->post(route("admin.users.store"))->assertRedirect(route('login'));
        $this->get(route("admin.users.edit", 'does-not-exist'))->assertRedirect(route('login'));
        $this->post(route("admin.users.update", 'does-not-exist'))->assertRedirect(route('login'));
        $this->get(route("admin.users.delete", 'does-not-exist'))->assertRedirect(route('login'));
    }
}