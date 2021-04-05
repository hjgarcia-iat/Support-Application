<?php

namespace Tests\Feature\App\Http\Requests;

use App\Http\Requests\RequestProductInformationRequest;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;

/**
 * Class RequestProductInformationRequestTest
 * @package Tests\Feature
 */
class RequestProductInformationRequestTest extends TestCase
{
    /**
     * @dataProvider validData
     */
    public function test_valid_data(array $data)
    {
        $request = new RequestProductInformationRequest();

        $validator = \Validator::make($data, $request->rules());
        //test data passes
        $this->assertTrue($validator->passes());
    }

    /**
     * @dataProvider invalidData
     */
    public function test_invalid_data(array $data)
    {
        $request = new RequestProductInformationRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }

    public function validData(): array
    {
        $faker = \Faker\Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[
                'first_name'       => $faker->firstName,
                'last_name'        => $faker->lastName,
                'email'            => $faker->safeEmail,
                'phone'            => $faker->phoneNumber,
                'role'             => $faker->title,
                'school'           => $faker->company,
                'district'         => $faker->company,
                'city'             => $faker->city,
                'state'            => $faker->state,
                'product_interest' => $faker->word,
            ]]
        ];
    }

    public function invalidData(): array
    {
        $faker = \Faker\Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[//first name is required
                'last_name'        => $faker->lastName,
                'email'            => $faker->safeEmail,
                'phone'            => $faker->phoneNumber,
                'role'             => $faker->title,
                'school'           => $faker->company,
                'district'         => $faker->company,
                'city'             => $faker->city,
                'state'            => $faker->state,
                'product_interest' => $faker->word,
            ]],
            [[//last name is required
                'first_name'       => $faker->firstName,
                'email'            => $faker->safeEmail,
                'phone'            => $faker->phoneNumber,
                'role'             => $faker->title,
                'school'           => $faker->company,
                'district'         => $faker->company,
                'city'             => $faker->city,
                'state'            => $faker->state,
                'product_interest' => $faker->word,
            ]],
            [[//email is required
                'first_name'       => $faker->firstName,
                'last_name'        => $faker->lastName,
                'phone'            => $faker->phoneNumber,
                'role'             => $faker->title,
                'school'           => $faker->company,
                'district'         => $faker->company,
                'city'             => $faker->city,
                'state'            => $faker->state,
                'product_interest' => $faker->word,
            ]],
            [[//role is required
                'first_name'       => $faker->firstName,
                'last_name'        => $faker->lastName,
                'email'            => $faker->safeEmail,
                'phone'            => $faker->phoneNumber,
                'school'           => $faker->company,
                'district'         => $faker->company,
                'city'             => $faker->city,
                'state'            => $faker->state,
                'product_interest' => $faker->word,
            ]],
            [[//school is required
                'first_name'       => $faker->firstName,
                'last_name'        => $faker->lastName,
                'email'            => $faker->safeEmail,
                'phone'            => $faker->phoneNumber,
                'role'             => $faker->title,
                'district'         => $faker->company,
                'city'             => $faker->city,
                'state'            => $faker->state,
                'product_interest' => $faker->word,
            ]],
            [[//city if required
                'first_name'       => $faker->firstName,
                'last_name'        => $faker->lastName,
                'email'            => $faker->safeEmail,
                'phone'            => $faker->phoneNumber,
                'role'             => $faker->title,
                'school'           => $faker->company,
                'district'         => $faker->company,
                'state'            => $faker->state,
                'product_interest' => $faker->word,
            ]],
            [[//state is required
                'first_name'       => $faker->firstName,
                'last_name'        => $faker->lastName,
                'email'            => $faker->safeEmail,
                'phone'            => $faker->phoneNumber,
                'role'             => $faker->title,
                'school'           => $faker->company,
                'district'         => $faker->company,
                'state'            => $faker->state,
                'product_interest' => $faker->word,
            ]],
            [[//product interest is required
                'first_name'       => $faker->firstName,
                'last_name'        => $faker->lastName,
                'email'            => $faker->safeEmail,
                'phone'            => $faker->phoneNumber,
                'role'             => $faker->title,
                'school'           => $faker->company,
                'district'         => $faker->company,
                'state'            => $faker->state,
            ]]
        ];
    }

}
