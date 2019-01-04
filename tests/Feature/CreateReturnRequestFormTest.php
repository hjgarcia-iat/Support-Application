<?php

namespace Tests\Feature;

use App\Services\Spreadsheet\FakeSpreadsheet;
use App\Services\Spreadsheet\SpreadsheetInterface;
use Tests\TestCase;

/**
 * Class CreateReturnRequestFormTest
 * @package Tests\Feature
 */
class CreateReturnRequestFormTest extends TestCase
{
    /**
     * @test
     */
    public function we_can_view_the_return_request_form()
    {
        $spreadsheet = new FakeSpreadsheet();
        $this->app->instance(SpreadsheetInterface::class, $spreadsheet);
        $response = $this->get(route('return_request.create'));

        $response->assertStatus(200);
        $response->assertViewIs('return_request.create');
    }
}