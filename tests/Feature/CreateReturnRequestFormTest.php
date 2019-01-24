<?php

namespace Tests\Feature;

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

    public function setUp()
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
        $refund = factory(Refund::class)->create();

        $response = $this->get(route('return_request.create',$refund->rma_number));

        $response->assertStatus(200);
        $response->assertViewIs('return_request.create');
    }

    /**
     * @test
     */
    public function if_we_dont_have_the_rma_code_we_cannot_view_the_form()
    {
        $response = $this->get(route('return_request.create'));

        $response->assertStatus(404);
    }
}