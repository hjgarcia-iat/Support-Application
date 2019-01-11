<?php

namespace Tests\Acceptance;

use App\Services\Spreadsheet\FakeSpreadsheet;
use App\Services\Spreadsheet\SpreadsheetInterface;
use Carbon\Carbon;
use Sheets;
use Google;
use Tests\TestCase;

/**
 * Class StoreReturnRequestFormTest
 * @package Tests\Acceptance
 */
class StoreReturnRequestFormTest extends TestCase
{

    /**
     * @test
     */
    public function the_data_is_saved_to_the_spreadsheet()
    {
        Sheets::setService(Google::make('sheets'));
        Sheets::spreadsheet(env('GOOGLE_SPREADSHEET'));
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

        $this->assertEquals(Carbon::now()->format('m/d/Y'), resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[1]['Date Entered']);
        $this->assertEquals($data['Requester Name'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[1]['Requester Name']);
        $this->assertEquals($data['Requester Email'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[1]['Requester Email']);
        $this->assertEquals($data['District/Company Name'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[1]['District / Company Name']);
        $this->assertEquals($data['Order# or PO#'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[1]['Order# or PO#']);
        $this->assertEquals($data['RMA#'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[1]['RMA#']);
        $this->assertEquals($data['Reason for Return'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[1]['Reason for Return']);
        $this->assertEquals(1234, resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[1]['SKU']);
        $this->assertEquals(1, resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[1]['QTY']);

        $this->assertEquals(Carbon::now()->format('m/d/Y'), resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['Date Entered']);
        $this->assertEquals($data['Requester Name'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['Requester Name']);
        $this->assertEquals($data['Requester Email'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['Requester Email']);
        $this->assertEquals($data['District/Company Name'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['District / Company Name']);
        $this->assertEquals($data['Order# or PO#'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['Order# or PO#']);
        $this->assertEquals($data['RMA#'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['RMA#']);
        $this->assertEquals($data['Reason for Return'], resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['Reason for Return']);
        $this->assertEquals(1236, resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['SKU']);
        $this->assertEquals(4, resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()[2]['QTY']);
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