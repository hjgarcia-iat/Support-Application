<?php

namespace Tests\Acceptance;

use App\Services\Spreadsheet\FakeSpreadsheet;
use App\Services\Spreadsheet\SpreadsheetInterface;
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
        $response = $this->from(route('return_request.create'))
            ->post(route('return_request.store'), $this->validParams());

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Your information was saved. We will get back to you shortly.']);
        $this->assertTrue(resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()->contains(
            [
                'Requester Name'        => 'Jane Doe',
                'Requester Email'       => 'jdoe@email.com',
                'District/Company Name' => 'Some District',
                'Order# or PO#'         => '12345',
                "RMA#"                  => "",
                'Reason for Return'     => 'some valid reason',
                'SKU'                   => 1234,
                'QTY'                   => 1,
            ]
        ));

        $this->assertTrue(resolve('App\Services\Spreadsheet\SpreadsheetInterface')->get()->contains(
            [
                'Requester Name'        => 'Jane Doe',
                'Requester Email'       => 'jdoe@email.com',
                'District/Company Name' => 'Some District',
                'Order# or PO#'         => '12345',
                "RMA#"                  => "",
                'Reason for Return'     => 'some valid reason',
                'SKU'                   => 1236,
                'QTY'                   => 4,
            ]
        ));
    }

    /**
     * Valid Data
     * @param array $data
     * @return array
     */
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
                ['sku' => '1236', 'quantity' => 4],
            ],
        ], $data);
    }
}