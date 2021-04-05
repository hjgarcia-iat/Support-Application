<?php

namespace Tests\Feature\App\Http\Requests;

use App\Http\Requests\CalculatorRequest;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;

/**
 * Class CalculatorRequestTest
 * @package Tests\Feature
 */
class CalculatorRequestTest extends TestCase
{
    /**
     * @dataProvider validData
     */
    public function test_the_form_request_is_valid(array $data)
    {
        $request = new CalculatorRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    /**
     * @dataProvider invalidData
     */
    public function test_the_form_request_is_invalid(array $data)
    {
        $request = new CalculatorRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }

    public function validData(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[
                 'first_name'       => $faker->firstName,
                 'last_name'        => $faker->lastName,
                 'email'            => $faker->safeEmail,
                 'role'             => $faker->title,
                 'school'           => $faker->company,
                 'city'             => $faker->city,
                 'state'            => $faker->state,
             ]]
        ];
    }

    public function invalidData(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[//first name is required
                 'last_name'        => $faker->lastName,
                 'email'            => $faker->safeEmail,
                 'role'             => $faker->title,
                 'school'           => $faker->company,
                 'city'             => $faker->city,
                 'state'            => $faker->state,
             ]],
            [[//last name is required
              'first_name'       => $faker->firstName,
              'email'            => $faker->safeEmail,
              'role'             => $faker->title,
              'school'           => $faker->company,
              'city'             => $faker->city,
              'state'            => $faker->state,
             ]],
            [[//email is required
              'first_name'       => $faker->firstName,
              'last_name'        => $faker->lastName,
              'role'             => $faker->title,
              'school'           => $faker->company,
              'city'             => $faker->city,
              'state'            => $faker->state,
             ]],
            [[//is valid
              'first_name'       => $faker->firstName,
              'last_name'        => $faker->lastName,
              'email'            => 'email-invalid',
              'role'             => $faker->title,
              'school'           => $faker->company,
              'city'             => $faker->city,
              'state'            => $faker->state,
             ]],
            [[//role is required
              'first_name'       => $faker->firstName,
              'last_name'        => $faker->lastName,
              'email'            => $faker->safeEmail,
              'school'           => $faker->company,
              'city'             => $faker->city,
              'state'            => $faker->state,
             ]],
            [[//school is required
              'first_name'       => $faker->firstName,
              'last_name'        => $faker->lastName,
              'email'            => $faker->safeEmail,
              'role'             => $faker->title,
              'city'             => $faker->city,
              'state'            => $faker->state,
             ]],
            [[//city is required
              'first_name'       => $faker->firstName,
              'last_name'        => $faker->lastName,
              'email'            => $faker->safeEmail,
              'role'             => $faker->title,
              'school'           => $faker->company,
              'state'            => $faker->state,
             ]],
            [[//state is required
              'first_name'       => $faker->firstName,
              'last_name'        => $faker->lastName,
              'email'            => $faker->safeEmail,
              'role'             => $faker->title,
              'school'           => $faker->company,
              'city'             => $faker->city,
             ]],
        ];
    }

}
