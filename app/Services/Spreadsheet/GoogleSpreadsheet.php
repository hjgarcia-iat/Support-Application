<?php

namespace App\Services\Spreadsheet;

use Google;
use Illuminate\Support\Collection;
use Sheets;

class GoogleSpreadsheet implements SpreadsheetInterface
{

    /**
     * Get a collection
     *
     * @return Collection;
     * @throws \Exception
     */
    public function get()
    {
        Sheets::setService(Google::make('sheets'));
        Sheets::spreadsheet(env('GOOGLE_SPREADSHEET'));

        $rows = Sheets::sheet('Authorized Returns')->get();

        $header = $rows->pull(0);

        return Sheets::collection($header, $rows);
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function save($data)
    {
        Sheets::setService(Google::make('sheets'));
        Sheets::spreadsheet(env('GOOGLE_SPREADSHEET'));

        foreach ($data['products'] as $product) {
            Sheets::sheet('Authorized Returns')->range('')->append([
                [
                    $data['name'],
                    $data['email'],
                    $data['district'],
                    $data['order_number'],
                    $data['rma_number'],
                    $data['reason'],
                    $product['sku'],
                    $product['quantity'],
                ],
            ]);
        }
    }
}