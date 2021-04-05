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
    public function test_the_return_request_form_is_stored()
    {
        //set the google sheet service this will actually be connected to Google sheets
        Sheets::setService(Google::make('sheets'));
        Sheets::spreadsheet(config('google.config.spreadsheet'));
        Sheets::sheet('Authorized Returns')->range('3:100')->clear();

        $response = $this->from(route('return_request.create'))
            ->post(route('return_request.store'), $this->validParams());

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Your information was saved. We will get back to you shortly.']);

        $this->assertEquals(Carbon::now()->format('m/d/Y'), resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['Date Entered']);
        $this->assertEquals($this->validParams()['name'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['Requester Name']);
        $this->assertEquals($this->validParams()['email'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['Requester Email']);
        $this->assertEquals($this->validParams()['district'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['District / Company Name']);
        $this->assertEquals($this->validParams()['order_number'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['Order# or PO#']);
        $this->assertEquals($this->validParams()['rma_number'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['RMA#']);
        $this->assertEquals($this->validParams()['reason'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['Reason for Return']);
        $this->assertEquals($this->validParams()['products'][0]['sku'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['SKU']);
        $this->assertEquals($this->validParams()['products'][0]['quantity'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['QTY']);

        $this->assertEquals(Carbon::now()->format('m/d/Y'), resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['Date Entered']);
        $this->assertEquals($this->validParams()['name'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['Requester Name']);
        $this->assertEquals($this->validParams()['email'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['Requester Email']);
        $this->assertEquals($this->validParams()['district'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['District / Company Name']);
        $this->assertEquals($this->validParams()['order_number'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['Order# or PO#']);
        $this->assertEquals($this->validParams()['rma_number'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['RMA#']);
        $this->assertEquals($this->validParams()['reason'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['Reason for Return']);
        $this->assertEquals($this->validParams()['products'][1]['sku'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['SKU']);
        $this->assertEquals($this->validParams()['products'][1]['quantity'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[3]['QTY']);
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