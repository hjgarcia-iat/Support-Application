<?php

namespace App\Services\Spreadsheet;

use Illuminate\Support\Collection;

/**
 * Class FakeSpreadsheet
 * @package App\Services\Spreadsheet
 */
class FakeSpreadsheet implements SpreadsheetInterface
{
    /**
     * Spreadsheet fake
     * @var array
     */
    public $spreadsheet = [];

    /**
     * @return Collection;
     */
    public function get()
    {
        return collect($this->spreadsheet);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function save($data)
    {
        $products = $data['products'];

        foreach ($products as $product) {
            $this->spreadsheet[] = [
                'Requester Name'        => $data['name'],
                'Requester Email'       => $data['email'],
                'District/Company Name' => $data['district'],
                'Order# or PO#'         => $data['order_number'],
                'Reason for Return'     => $data['reason'],
                'SKU'                   => $product['sku'],
                'QTY'                   => $product['quantity'],
            ];
        }

        return $this->spreadsheet;
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
            ],
        ], $data);
    }


}