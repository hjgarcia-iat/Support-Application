<?php

namespace Tests\Acceptance\App\Http\Controllers;

use App\Services\CrmInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CalculatorControllerTest
 * @package Tests\Feature
 */
class CalculatorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_we_can_view_the_form()
    {
        $response = $this->get(route("calculator.show"));

        $response->assertStatus(200);
        $response->assertViewIs("calculator.show");
    }

    public function test_we_can_submit_the_results_of_the_calculator()
    {
        resolve(CrmInterface::class)->find('test');

        $data = [
            'first_name' => 'Jane',
            'last_name'  => 'Doe',
            'email'      => 'email@email.com',
            'phone'      => '000-0000-0000',
            'role'       => 'Classroom Teacher',
            'school'     => 'school',
            'city'       => 'city',
            'state'      => 'AA',
        ];

        $response = $this->post(route('calculator.store'), $data);

        //get the record

        $this->assertEquals(resolve(CrmInterface::class)->find('A1'), $data);
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true
        ]);

        //delete the record
    }
}