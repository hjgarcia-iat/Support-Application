<?php

namespace Tests\Feature\App\Http\Requests\Admin;

use App\Http\Requests\Admin\AccountRequest;
use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class AccountRequestTest
 * @package Tests\Feature
 */
class AccountRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @dataProvider validData
     */
    public function test_valid_data(array $data)
    {
        $request = new AccountRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    /**
     * @dataProvider invalidData
     */
    public function test_invalid_data(array $data)
    {
        $request = new AccountRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }

    public function test_password_is_not_required()
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $data = [
            'name' => 'Jane Doe',
            'email' => 'jdoe@email.com',
        ];

        $response = $this->actingAs($user)
            ->from(route('admin.account.edit'))
            ->post(route("admin.account.update"), $data);

        $response->assertRedirect(route('admin.account.edit'));
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

    public function validData(): array
    {
        $faker = \Faker\Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[
                'name' => $faker->firstName,
                'email' => $faker->safeEmail,
                'password' => 'Password1',
            ]]
        ];
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
        ];
    }

    public function invalidPasswordData(): array
    {
        $faker = \Faker\Factory::create(Factory::DEFAULT_LOCALE);

        return [
            'password must at least characters' => [[
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'password' => 'Pa1'
            ]],
            'password must have numbers' => [[
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'password' => 'Password'
            ]],
            'password must have letters' => [[
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'password' => '12345678'
            ]],
            'password must have case difference' => [[
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'password' => 'password1'
            ]],
        ];
    }

}
