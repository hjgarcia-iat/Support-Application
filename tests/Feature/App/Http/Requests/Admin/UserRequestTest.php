<?php

namespace Tests\Feature\App\Http\Requests\Admin;

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_with_valid_data_can_be_created()
    {
        $authenticatedUser = User::factory()->create();
        $data = [
            'name' => 'Jane Doe',
            'email' => 'jdoe@email.com',
            'password' => 'Password1',
            'password_confirmation' => 'Password1'
        ];

        $response = $this->actingAs($authenticatedUser)
            ->post(route("admin.users.store"), $data);

        $response->assertRedirect(route('admin.users'));
        $this->assertTrue(\Hash::check('Password1', User::where('email', $data['email'])->first()->password));
        $this->assertDatabaseHas('users', [
            'name' => 'Jane Doe',
            'email' => 'jdoe@email.com',
        ]);
    }

    public function test_password_is_not_required_to_update_a_user()
    {
        $authenticatedUser = User::factory()->create();
        $user = User::factory()->create();

        $data = [
            'name' => 'Jane Doe',
            'email' => 'jdoe@email.com',
        ];

        $response = $this->actingAs($authenticatedUser)
            ->from(route('admin.users.edit', $user))
            ->post(route("admin.users.update", $user), $data);

        $response->assertRedirect(route('admin.users.edit', $user));
        $this->assertTrue(\Hash::check('password', $user->fresh()->password));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Jane Doe',
            'email' => 'jdoe@email.com',
        ]);
    }

    public function test_we_can_update_a_user_if_the_email_provided_is_the_same_as_the_user_being_updated()
    {
        $authenticatedUser = User::factory()->create();
        $user = User::factory()->create(['email' => 'jdoe@email.com']);

        $data = [
            'name' => 'Jane Doe',
            'email' => 'jdoe@email.com',
        ];

        $response = $this->actingAs($authenticatedUser)
            ->from(route('admin.users.edit', $user))
            ->post(route("admin.users.update", $user), $data);

        $response->assertRedirect(route('admin.users.edit', $user));
        $this->assertTrue(\Hash::check('password', $user->fresh()->password));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Jane Doe',
            'email' => 'jdoe@email.com',
        ]);
    }

    /**
     * @dataProvider invalidData
     */
    public function test_a_user_with_invalid_data_cannot_be_created(array $data)
    {
        $authenticatedUser = User::factory()->create();
        User::factory()->create(['email' => 'email@email.com']);

        $response = $this->actingAs($authenticatedUser)
            ->from(route('admin.users.create'))
            ->post(route("admin.users.store"), $data);

        $response->assertRedirect(route('admin.users.create'));
        $this->assertDatabaseCount('users', 2);
    }

    public function invalidData(): array
    {
        $faker = \Faker\Factory::create(Factory::DEFAULT_LOCALE);

        return [
            'name is required' => [[
                'email' => $faker->safeEmail,
                'password' => 'Password1',
                'password_confirmation' => 'Password1'
            ]],
            'email is required' => [[
                'name' => $faker->name,
                'password' => 'Password1',
                'password_confirmation' => 'Password1'
            ]],
            'email is valid' => [[
                'name' => $faker->name,
                'email' => 'invalid-email',
                'password' => 'Password1',
                'password_confirmation' => 'Password1'
            ]],
            'email is unique' => [[
                'name' => $faker->name,
                'email' => 'email@email.com',
                'password' => 'Password1',
                'password_confirmation' => 'Password1'
            ]],
            'password must at least characters' => [[
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'password' => 'Pa1',
                'password_confirmation' => 'Pa1',
            ]],
            'password must have numbers' => [[
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'password' => 'Password',
                'password_confirmation' => 'Password',
            ]],
            'password must have letters' => [[
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'password' => '12345678',
                'password_confirmation' => '12345678',
            ]],
            'password must have case difference' => [[
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'password' => 'password1',
                'password_confirmation' => 'password1',
            ]],
            'passwords needs to be confirmed' => [[
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'password' => 'Password1',
                'password_confirmation' => 'WordPass1'
            ]],
        ];
    }
}
