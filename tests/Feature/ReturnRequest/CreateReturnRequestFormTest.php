<?php

namespace Tests\Feature\ReturnRequest;

use App\Services\Spreadsheet\FakeSpreadsheet;
use App\Services\Spreadsheet\SpreadsheetInterface;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * Class CreateReturnRequestFormTest
 * @package Tests\Feature
 */
class CreateReturnRequestFormTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $spreadsheet = new FakeSpreadsheet();
        $this->app->instance(SpreadsheetInterface::class, $spreadsheet);
    }

    /**
     * @test
     */
    public function we_can_view_the_return_request_form()
    {
        $response = $this->get(route('return_request.create'));

        $response->assertStatus(200);
        $response->assertViewIs('return_request.create');
    }
}