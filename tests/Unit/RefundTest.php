<?php

namespace Tests\Unit;

use App\Refund;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RefundTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_the_correct_fields()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'jdoe@email.com',
            'district' => 'some district',
            'order_number' => 'order_number',
            'rma_number' => 'rma_number',
            'reason' => 'some reason',
        ];

        Refund::factory()->create($data);

        $this->assertDatabaseHas('refunds', $data);
    }
}
