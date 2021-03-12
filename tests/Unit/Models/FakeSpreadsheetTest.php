<?php

namespace Tests\Unit\Models;

use App\Services\Spreadsheet\FakeSpreadsheet;
use App\Services\Spreadsheet\SpreadsheetInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Tests\TestCase;

/**
 * Class FakeSpreadsheetTest
 * @package Tests\Unit
 */
class FakeSpreadsheetTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_a_collection_of_results()
    {
        $spreadsheet = new FakeSpreadsheet();
        $this->app->instance(SpreadsheetInterface::class, $spreadsheet);

        $this->assertInstanceOf(Collection::class, $spreadsheet->get());
    }

    /**
     * @test
     */
    public function it_saves_data_to_a_spreadsheet()
    {
        $spreadsheet = new FakeSpreadsheet();
        $this->app->instance(SpreadsheetInterface::class, $spreadsheet);

        $spreadsheet->save($this->validData());

        $this->assertEquals($spreadsheet->spreadsheet, [
            [
                "Date Entered" => Carbon::now()->format('m/d/Y'),
                'Requester Name' => 'Jane Doe',
                'Requester Email' => 'jdoe@email.com',
                'District/Company Name' => 'Some District',
                'Order# or PO#' => '12345',
                "RMA Number" => "12345",
                'Reason for Return' => 'some valid reason',
                'SKU' => '1234',
                'QTY' => 1,
            ]
        ]);
    }

    /**
     * @return array
     */
    private function validData()
    {
        return [
            'name' => 'Jane Doe',
            'email' => 'jdoe@email.com',
            'district' => 'Some District',
            'rma_number' => '12345',
            'order_number' => '12345',
            'reason' => 'some valid reason',
            'products' => [
                ['sku' => '1234', 'quantity' => 1],
            ],
        ];
    }
}