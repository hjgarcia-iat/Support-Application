<?php

namespace Tests\Acceptance\App\Http\Controllers;

use Carbon\Carbon;
use Google;
use Sheets;
use Tests\TestCase;

/**
 * Class ReturnRequestControllerTest
 * @package Tests\Acceptance
 */
class ReturnRequestControllerTest extends TestCase
{
    /**
     *
     */
    public function test_the_the_form_is_saved()
    {
        Sheets::setService(Google::make('sheets'));
        Sheets::spreadsheet(config('google.config.spreadsheet'));
        Sheets::sheet('Authorized Returns')->range('3:100')->clear();

        $response = $this->from(route('return_request.create'))
            ->post(route('return_request.store'), $this->validParams());

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Your information was saved. We will get back to you shortly.']);

        $data = [
            'Date Entered' => Carbon::now()->format('m/d/Y'),
            'Requester Name' => 'Jane Doe',
            'Requester Email' => 'jdoe@email.com',
            'District/Company Name' => 'Some District',
            'Order# or PO#' => '12345',
            "RMA#" => '12345',
            'Reason for Return' => 'some valid reason',
            'SKU' => 1234,
            'QTY' => 1,
        ];

        $this->assertEquals(Carbon::now()->format('m/d/Y'), resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['Date Entered']);
        $this->assertEquals($data['Requester Name'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['Requester Name']);
        $this->assertEquals($data['Requester Email'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['Requester Email']);
        $this->assertEquals($data['District/Company Name'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['District / Company Name']);
        $this->assertEquals($data['Order# or PO#'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['Order# or PO#']);
        $this->assertEquals($data['RMA#'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['RMA#']);
        $this->assertEquals($data['Reason for Return'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['Reason for Return']);
        $this->assertEquals(1234, resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['SKU']);
        $this->assertEquals(1, resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['QTY']);

        $this->assertEquals(Carbon::now()->format('m/d/Y'), resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['Date Entered']);
        $this->assertEquals($data['Requester Name'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['Requester Name']);
        $this->assertEquals($data['Requester Email'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['Requester Email']);
        $this->assertEquals($data['District/Company Name'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['District / Company Name']);
        $this->assertEquals($data['Order# or PO#'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['Order# or PO#']);
        $this->assertEquals($data['RMA#'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['RMA#']);
        $this->assertEquals($data['Reason for Return'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['Reason for Return']);
        $this->assertEquals(1236, resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['SKU']);
        $this->assertEquals(4, resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['QTY']);
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