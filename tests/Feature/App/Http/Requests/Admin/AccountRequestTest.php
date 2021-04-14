<?php

namespace Tests\Feature\App\Http\Requests\Admin;

use App\Http\Requests\Admin\AccountRequest;
use Faker\Factory;
use Tests\TestCase;

/**
 * Class AccountRequestTest
 * @package Tests\Feature
 */
class AccountRequestTest extends TestCase
{
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

    public function validData(): array
    {
        $faker = \Faker\Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[
                'name' => $faker->firstName,
                'email' => $faker->safeEmail,
                'password' => 'password',
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

}
