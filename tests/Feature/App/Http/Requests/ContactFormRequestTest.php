<?php

namespace Tests\Feature\App\Http\Requests;

use App\Http\Requests\ContactFormRequest;
use Faker\Factory;
use Tests\TestCase;

/**
 * Class ContactFormRequestTest
 * @package Tests\Feature
 */
class ContactFormRequestTest extends TestCase
{
    /**
     * @dataProvider validData
     */
    public function test_the_form_request_is_valid(array $data)
    {
        $request = new ContactFormRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    /**
     * @dataProvider invalidData
     */
    public function test_the_form_request_is_invalid(array $data)
    {
        $request = new ContactFormRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }

    public function validData(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[
                 'reason'   => $faker->word,
                 'name'     => $faker->name,
                 'email'    => $faker->safeEmail,
                 'district' => $faker->title,
                 'subject'  => $faker->word,
                 'details'  => $faker->paragraph,
             ]]
        ];
    }

    public function invalidData(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[//reason is required
                 'name'     => $faker->name,
                 'email'    => $faker->safeEmail,
                 'district' => $faker->title,
                 'subject'  => $faker->word,
                 'details'  => $faker->paragraph,
             ]],
            [[//name is required
                 'reason'   => $faker->word,
                 'email'    => $faker->safeEmail,
                 'district' => $faker->title,
                 'subject'  => $faker->word,
                 'details'  => $faker->paragraph,
             ]],
            [[//email is required
                 'reason'   => $faker->word,
                 'name'     => $faker->name,
                 'district' => $faker->title,
                 'subject'  => $faker->word,
                 'details'  => $faker->paragraph,
             ]],
            [[//email is valid
                 'reason'   => $faker->word,
                 'name'     => $faker->name,
                 'email'    => 'invalid-email',
                 'district' => $faker->title,
                 'subject'  => $faker->word,
                 'details'  => $faker->paragraph,
             ]],
            [[//district is required
                 'reason'   => $faker->word,
                 'name'     => $faker->name,
                 'email'    => $faker->safeEmail,
                 'subject'  => $faker->word,
                 'details'  => $faker->paragraph,
             ]],
            [[//subject is required
                 'reason'   => $faker->word,
                 'name'     => $faker->name,
                 'email'    => $faker->safeEmail,
                 'district' => $faker->title,
                 'details'  => $faker->paragraph,
             ]],
            [[//details is required
                 'reason'   => $faker->word,
                 'name'     => $faker->name,
                 'email'    => $faker->safeEmail,
                 'district' => $faker->title,
                 'subject'  => $faker->word,
             ]],
        ];
    }

}
