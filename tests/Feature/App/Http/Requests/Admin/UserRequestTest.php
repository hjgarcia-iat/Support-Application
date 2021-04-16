<?php

namespace Tests\Feature\App\Http\Requests\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @dataProvider validData
     */
    public function test_valid_data(array $data)
    {
        $request = new UserRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function validData(): array
    {
        $faker = \Faker\Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[
                'name' => $faker->firstName,
                'email' => $faker->safeEmail,
                'password' => 'Password1',
                'password_confirmation' => 'Password1',
            ]]
        ];
    }

    /**
     * @dataProvider invalidData
     */
    public function test_invalid_data(array $data)
    {
        User::factory()->create(['email' => 'email@email.com']);
        $request = new UserRequest();
        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }

    public function invalidData(): array
    {
        $faker = \Faker\Factory::create(Factory::DEFAULT_LOCALE);

        return [
            'name is required' => [[
                'email' => $faker->safeEmail,
            ]],
            'email is required' => [[
                'name' => $faker->name,
            ]],
            'email is valid' => [[
                'name' => $faker->name,
                'email' => 'invalid-email',
            ]],
            'email is unique' => [[
                'name' => $faker->name,
                'email' => 'email@email.com',
            ]],
        ];
    }


    public function test_password_is_not_required()
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

    public function test_we_can_update_a_user_if_the_email_provided_is_the_same()
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
     * @dataProvider invalidPasswordData
     */
    public function test_invalid_password_data(array $data)
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $response = $this->actingAs($user)
            ->from(route('admin.account.edit'))
            ->post(route("admin.account.update"), $data);

        $response->assertRedirect(route('admin.account.edit'));
        $this->assertTrue(\Hash::check('password', $user->fresh()->password));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $user->fresh()->name,
            'email' => $user->fresh()->email,
        ]);
    }


    public function invalidPasswordData(): array
    {
        $faker = \Faker\Factory::create(Factory::DEFAULT_LOCALE);

        return [
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
