<?php

namespace Tests\Unit\Models;

use App\Status;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_the_correct_fields()
    {
        $data = [
            'post' => 'Test',
            'type' => 'High',
        ];

        Status::factory()->create($data);

        $this->assertDatabaseHas('statuses', $data);
    }
}
