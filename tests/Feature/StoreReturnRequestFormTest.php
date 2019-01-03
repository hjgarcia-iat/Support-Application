<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Class StoreReturnRequestFormTest
 * @package Tests\Feature
 */
class StoreReturnRequestFormTest extends TestCase
{
    /**
     * @test
     */
    public function the_name_field_is_required()
    {
        $response = $this->from(route('return_request.create'))
            ->post(route('return_request.store'), $this->validParams(['name' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('return_request.create'));
        $response->assertSessionHasErrors('name');
    }

    /**
     * @test
     */
    public function the_email_field_is_required()
    {
        $response = $this->from(route('return_request.create'))
            ->post(route('return_request.store'), $this->validParams(['email' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('return_request.create'));
        $response->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function the_email_field_is_valid()
    {
        $response = $this->from(route('return_request.create'))
            ->post(route('return_request.store'), $this->validParams(['email' => 'invalid-email']));

        $response->assertStatus(302);
        $response->assertRedirect(route('return_request.create'));
        $response->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function the_district_field_is_required()
    {
        $response = $this->from(route('return_request.create'))
            ->post(route('return_request.store'), $this->validParams(['district' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('return_request.create'));
        $response->assertSessionHasErrors('district');
    }

    /**
     * @test
     */
    public function the_order_number_field_is_required()
    {
        $response = $this->from(route('return_request.create'))
            ->post(route('return_request.store'), $this->validParams(['order_number' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('return_request.create'));
        $response->assertSessionHasErrors('order_number');
    }

    /**
     * @test
     */
    public function the_reason_field_is_required()
    {
        $response = $this->from(route('return_request.create'))
            ->post(route('return_request.store'), $this->validParams(['reason' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('return_request.create'));
        $response->assertSessionHasErrors('reason');
    }

    /**
     * @test
     */
    public function the_sku_field_is_required()
    {
        $response = $this->from(route('return_request.create'))
            ->post(route('return_request.store'), $this->validParams(['products' => ['sku' => '', 'quantity' => 1]]));

        $response->assertStatus(302);
        $response->assertRedirect(route('return_request.create'));
        $response->assertSessionHasErrors('products.*.sku');
    }

    /**
     * @test
     */
    public function the_quantity_field_is_required()
    {
        $response = $this->from(route('return_request.create'))
            ->post(route('return_request.store'), $this->validParams(['products' => ['sku' => '1234','quantity' => '']]));

        $response->assertStatus(302);
        $response->assertRedirect(route('return_request.create'));
        $response->assertSessionHasErrors('products.*.quantity');
    }

    /**
     * @test
     */
    public function the_quantity_field_is_a_number()
    {
        $response = $this->from(route('return_request.create'))
            ->post(route('return_request.store'), $this->validParams(['products' => ['sku' => '1234','quantity' => 'invalid-quantity']]));

        $response->assertStatus(302);
        $response->assertRedirect(route('return_request.create'));
        $response->assertSessionHasErrors('products.*.quantity');
    }


    private function validParams($data = [])
    {
        return array_merge([
            'name'         => 'Jane Doe',
            'email'        => 'jdoe@email.com',
            'district'     => 'Some District',
            'order_number' => '12345',
            'reason'       => 'some valid reason',
            'products'     => [
                ['sku' => '1234', 'quantity' => 1],
            ],
        ], $data);
    }
}