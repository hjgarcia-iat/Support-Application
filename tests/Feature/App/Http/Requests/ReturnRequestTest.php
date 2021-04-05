<?php

namespace Tests\Feature\App\Http\Requests;

use App\Http\Requests\ReturnRequest;
use Faker\Factory;
use Tests\TestCase;

/**
 * Class ReturnRequestTest
 * @package Tests\Feature
 */
class ReturnRequestTest extends TestCase
{
    /**
     * @dataProvider validData
     */
    public function test_valid_data(array $data)
    {
        $request = new ReturnRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    /**
     * @dataProvider invalidData
     */
    public function test_invalid_data(array $data)
    {
        $request = new ReturnRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }


    public function validData(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[
                 'name'         => $faker->name,
                 'email'        => $faker->email,
                 'district'     => $faker->company,
                 'order_number' => '1234',
                 'rma_number'   => '1234',
                 'reason'       => $faker->word,
                 'products'     => [
                     [
                         'sku'      => '1234',
                         'quantity' => 1
                     ]
                 ]
             ]]
        ];
    }

    public function invalidData(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            'name is required'                    => [[//name is required
                                                       'email'        => $faker->email,
                                                       'district'     => $faker->company,
                                                       'order_number' => '1234',
                                                       'rma_number'   => '1234',
                                                       'reason'       => $faker->word,
                                                       'products'     => [
                                                           [
                                                               'sku'      => '1234',
                                                               'quantity' => 1
                                                           ]
                                                       ]
                                                      ]],
            'email is required'                   => [[//email is required
                                                       'name'         => $faker->name,
                                                       'district'     => $faker->company,
                                                       'order_number' => '1234',
                                                       'rma_number'   => '1234',
                                                       'reason'       => $faker->word,
                                                       'products'     => [
                                                           [
                                                               'sku'      => '1234',
                                                               'quantity' => 1
                                                           ]
                                                       ]
                                                      ]],
            'email is invalid'                    => [[//email is valid
                                                       'name'         => $faker->name,
                                                       'email'        => 'invalid-email',
                                                       'district'     => $faker->company,
                                                       'order_number' => '1234',
                                                       'rma_number'   => '1234',
                                                       'reason'       => $faker->word,
                                                       'products'     => [
                                                           [
                                                               'sku'      => '1234',
                                                               'quantity' => 1
                                                           ]
                                                       ]
                                                      ]],
            'district is required'                => [[//district is required
                                                       'name'         => $faker->name,
                                                       'email'        => $faker->email,
                                                       'order_number' => '1234',
                                                       'rma_number'   => '1234',
                                                       'reason'       => $faker->word,
                                                       'products'     => [
                                                           [
                                                               'sku'      => '1234',
                                                               'quantity' => 1
                                                           ]
                                                       ]
                                                      ]],
            'order number is required'            => [[//order number is required
                                                       'name'       => $faker->name,
                                                       'email'      => $faker->email,
                                                       'district'   => $faker->company,
                                                       'rma_number' => '1234',
                                                       'reason'     => $faker->word,
                                                       'products'   => [
                                                           [
                                                               'sku'      => '1234',
                                                               'quantity' => 1
                                                           ]
                                                       ]
                                                      ]],
            'rma number is required'              => [[//rma number is required
                                                       'name'         => $faker->name,
                                                       'email'        => $faker->email,
                                                       'district'     => $faker->company,
                                                       'order_number' => '1234',
                                                       'reason'       => $faker->word,
                                                       'products'     => [
                                                           [
                                                               'sku'      => '1234',
                                                               'quantity' => 1
                                                           ]
                                                       ]
                                                      ]],
            'product is required'                 => [[//products is required
                                                       'name'                => $faker->name,
                                                       'email'               => $faker->email,
                                                       'district'            => $faker->company,
                                                       'order_number'        => '1234',
                                                       'rma_number'          => '1234',
                                                       'reason'              => $faker->word,
                                                      ]],
            'product sku is required'             => [[//product sku is required
                                                       'name'                => $faker->name,
                                                       'email'               => $faker->email,
                                                       'district'            => $faker->company,
                                                       'order_number'        => '1234',
                                                       'rma_number'          => '1234',
                                                       'reason'              => $faker->word,
                                                       'products'     => [
                                                           [
                                                               'quantity' => 1
                                                           ]
                                                       ]
                                                      ]],
            'product quantities is required'      => [[//product quantities is required
                                                       'name'           => $faker->name,
                                                       'email'          => $faker->email,
                                                       'district'       => $faker->company,
                                                       'order_number'   => '1234',
                                                       'rma_number'     => '1234',
                                                       'reason'         => $faker->word,
                                                       'products'     => [
                                                           [
                                                               'sku'      => '1234',
                                                           ]
                                                       ]
                                                      ]],
            'product quantities must be a number' => [[//product quantities musty be an integer
                                                       'name'         => $faker->name,
                                                       'email'        => $faker->email,
                                                       'district'     => $faker->company,
                                                       'order_number' => '1234',
                                                       'rma_number'   => '1234',
                                                       'reason'       => $faker->word,
                                                       'products'     => [
                                                           [
                                                               'sku'      => '1234',
                                                               'quantity' => 'abc'
                                                           ]
                                                       ]
                                                      ]],
        ];
    }

}
