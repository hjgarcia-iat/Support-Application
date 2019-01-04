<?php

namespace App\Services\Spreadsheet;

use Illuminate\Support\Collection;

/**
 * Interface SpreadsheetInterface
 * @package App\Services\Spreadsheet
 */
interface SpreadsheetInterface
{
    /**
     * @return Collection;
     */
    public function get();

    /**
     * @param $data
     * @return mixed
     */
    public function save($data);
}