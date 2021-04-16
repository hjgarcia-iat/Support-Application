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
        $users             = User::factory(4)->create();

        $response = $this->actingAs($authenticatedUser)->get(route("admin.users"));

        $response->assertStatus(200);
        $response->assertViewIs("admin.users.index");
        $response->assertDontSee($authenticatedUser->id);
        $users->each(function ($user) use ($response) {
            $response->assertSee($user->id);
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
        $data              = [
            'name'                  => 'Jane Doe',
            'email'                 => 'jdoe@email.com',
            'password'              => 'NewPassword1',
            'password_confirmation' => 'NewPassword1',
        ];

        $response = $this->actingAs($authenticatedUser)->post(route("admin.users.store",), $data);

        $response->assertRedirect(route('admin.users'));
        $this->assertDatabaseHas('users', [
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);
        $this->assertTrue(\Hash::check($data['password'], User::where('email', $data['email'])->first()->password));
    }
}