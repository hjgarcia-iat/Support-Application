<?php

namespace Tests\Feature\App\Http\Requests\Admin;

use App\Http\Requests\Admin\StatusRequest;
use Faker\Factory;

use Tests\TestCase;

/**
 * Class StatusRequestTest
 * @package Tests\Feature
 */
class StatusRequestTest extends TestCase
{
    /**
     * @dataProvider validData
     */
    public function test_valid_data(array $data)
    {
        $request = new StatusRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function validData(): array
    {
        $faker = \Faker\Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[
                'post' => $faker->paragraph,
                'type' => $faker->randomElement(['High', 'Medium', 'Low', 'Default']),
            ]]
        ];
    }

    /**
     * @dataProvider invalidData
     */
    public function test_invalid_data(array $data)
    {
        $request = new StatusRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }

    public function invalidData(): array
    {
        $faker = \Faker\Factory::create(Factory::DEFAULT_LOCALE);

        return [
            'post field is required' => [[
                'type' => $faker->randomElement(['High', 'Medium', 'Low', 'Default']),
            ]],
            'type field is required' => [[
                'post' => $faker->paragraph
            ]],
            'type field must be a certain type' => [[
                'post' => $faker->paragraph,
                'type' => 'not allowed'
            ]]
        ];
    }
}
