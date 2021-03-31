<?php

namespace Tests\Feature\ReturnRequest;

use App\Refund;
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
        $refund = Refund::factory()->create();
        $response = $this->get(route('return_request.create', $refund->rma_number));

        $response->assertStatus(200);
        $response->assertViewIs('return_request.create');
    }

    /**
     * @test
     */
    public function we_get_a_404_error_if_the_rma_code_does_not_exist()
    {
        $this->get(route('return_request.create', ['non-existent-rma-code']))->assertStatus(404);
    }
}