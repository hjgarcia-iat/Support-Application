<?php

namespace Tests\Feature\ReturnRequest;

use App\Services\Spreadsheet\FakeSpreadsheet;
use App\Services\Spreadsheet\SpreadsheetInterface;
use Carbon\Carbon;
use Tests\TestCase;

/**
 * Class StoreReturnRequestFormTest
 * @package Tests\Feature
 */
class StoreReturnRequestFormTest extends TestCase
{
    /**
     * @var FakeSpreadsheet
     */
    protected $spreadsheet;

    public function setUp(): void
    {
        parent::setUp();
        $this->spreadsheet = new FakeSpreadsheet();
        $this->app->instance(SpreadsheetInterface::class, $this->spreadsheet);
    }

    /**
     * @test
     */
    public function the_data_is_saved_to_the_spreadsheet()
    {
        $response = $this->from(route('return_request.create'))
            ->post(route('return_request.store'), $this->validParams());

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Your information was saved. We will get back to you shortly.']);
        $this->assertEquals([
            'Date Entered' => Carbon::now()->format('m/d/Y'),
            'Requester Name' => 'Jane Doe',
            'Requester Email' => 'jdoe@email.com',
            'District/Company Name' => 'Some District',
            'Order# or PO#' => '12345',
            'RMA Number' => '12345',
            'Reason for Return' => 'some valid reason',
            'SKU' => 1234,
            'QTY' => 1,
        ], $this->spreadsheet->get()[0]);

        $this->assertEquals([
            'Date Entered' => Carbon::now()->format('m/d/Y'),
            'Requester Name' => 'Jane Doe',
            'Requester Email' => 'jdoe@email.com',
            'District/Company Name' => 'Some District',
            'Order# or PO#' => '12345',
            'RMA Number' => '12345',
            'Reason for Return' => 'some valid reason',
            'SKU' => 1236,
            'QTY' => 4,
        ], $this->spreadsheet->get()[1]);
    }


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
    public function the_rma_number_field_is_required()
    {
        $response = $this->from(route('return_request.create'))
            ->post(route('return_request.store'), $this->validParams(['rma_number' => '']));

        $response->assertStatus(302);
        $response->assertRedirect(route('return_request.create'));
        $response->assertSessionHasErrors('rma_number');
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
            ->post(route('return_request.store'), $this->validParams(['products' => ['sku' => '1234', 'quantity' => '']]));

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
            ->post(route('return_request.store'), $this->validParams(['products' => ['sku' => '1234', 'quantity' => 'invalid-quantity']]));

        $response->assertStatus(302);
        $response->assertRedirect(route('return_request.create'));
        $response->assertSessionHasErrors('products.*.quantity');
    }

    /**
     * Valid Data
     * @param array $data
     * @return array
     */
    private function validParams($data = [])
    {
        return array_merge([
            'name' => 'Jane Doe',
            'email' => 'jdoe@email.com',
            'district' => 'Some District',
            'order_number' => '12345',
            'rma_number' => '12345',
            'reason' => 'some valid reason',
            'products' => [
                ['sku' => '1234', 'quantity' => 1],
                ['sku' => '1236', 'quantity' => 4],
            ],
        ], $data);
    }
}