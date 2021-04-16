<?php

namespace Tests\Feature\App\Console\Commands;

use App\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_post_a_default_status_post()
    {
        \Artisan::call('system-status:update');

        $this->assertCount(1, Status::all());
        $this->assertDatabaseHas('statuses', [
            'type' => Status::DEFAULT,
            'post' => 'All systems operational.',
        ]);
    }

    public function test_it_will_not_create_default_post_status_if_post_exists_for_that_day()
    {
        Status::factory()->create(['type' => Status::LOW,'post' => 'post']);

        $this->assertCount(1, Status::all());

        \Artisan::call('system-status:update');

        $this->assertCount(1, Status::all());
        $this->assertDatabaseMissing('statuses', [
            'type' => Status::DEFAULT,
            'post' => 'All systems operational.',
        ]);
    }

    public function test_it_will_create_default_post_status_if_post_exists_a_day_in_the_past()
    {
        Status::factory()->create(['type' => Status::LOW, 'post' => 'post','created_at' => now()->subDay()]);

        $this->assertCount(1, Status::all());

        \Artisan::call('system-status:update');

        $this->assertCount(2, Status::all());
        $this->assertDatabaseHas('statuses', [
            'type' => Status::DEFAULT,
            'post' => 'All systems operational.',
        ]);
    }

    public function test_it_will_not_create_default_post_status_if_the_same_type_of_post_exists_for_that_day()
    {
        Status::factory()->create([
            'type' => Status::DEFAULT,
            'post' => 'All systems operational.',
            'created_at' => now()
        ]);

        $this->assertCount(1, Status::all());

        \Artisan::call('system-status:update');

        $this->assertCount(1, Status::all());
    }
}