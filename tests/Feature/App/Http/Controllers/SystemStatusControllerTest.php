<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Status;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class SystemStatusControllerTest
 * @package Tests\Feature
 */
class SystemStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_we_can_see_the_system_status_home_page()
    {
        $statusA = Status::factory()->create(['created_at' => Carbon::now()->subDays(1)]);
        $statusB = Status::factory()->create(['created_at' => Carbon::now()->subDays(2)]);
        $statusC = Status::factory()->create(['created_at' => Carbon::now()->subDays(6)]);
        $statusD = Status::factory()->create(['created_at' => Carbon::now()->subDays(6)]);
        $statusE = Status::factory()->create(['created_at' => Carbon::now()->subDays(6)]);
        $statusF = Status::factory()->create(['created_at' => Carbon::now()->subDays(6)]);
        $statusG = Status::factory()->create(['created_at' => Carbon::now()->subDays(6)]);
        $statusH = Status::factory()->create(['created_at' => Carbon::now()->subDays(8)]);

        $response = $this->get(route('system_status.index'));

        $response->assertStatus(200);
        $response->assertViewIs('system_status.index');
        $response->assertSee($statusA->post);
        $response->assertSee($statusB->post);
        $response->assertSee($statusC->post);
        $response->assertSee($statusD->post);
        $response->assertSee($statusE->post);
        $response->assertSee($statusF->post);
        $response->assertSee($statusG->post);
        $response->assertDontSee($statusH->post);
    }
}