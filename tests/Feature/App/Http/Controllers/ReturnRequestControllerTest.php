<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Services\Spreadsheet\FakeSpreadsheet;
use App\Services\Spreadsheet\SpreadsheetInterface;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ReturnRequestControllerTest
 * @package Tests\Feature
 */
class ReturnRequestControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_we_can_view_the_form()
    {
        $response = $this->get(route('return_request.create'));

        $response->assertStatus(200);
        $response->assertViewIs('return_request.create');
    }

    public function test_we_can_submit_the_return_request_form()
    {
        $spreadsheet = new FakeSpreadsheet();
        $this->app->instance(SpreadsheetInterface::class, $spreadsheet);
        $data = [
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
        ];

        $response = $this->post(route('return_request.store'), $data);

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
        ], $spreadsheet->get()[0]);

    }
}