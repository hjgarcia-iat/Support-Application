<?php

namespace Tests\Unit\Models;

use App\Services\CrmInterface;
use Tests\TestCase;

class CrmFakeTest extends TestCase
{
    public function test_it_can_get_a_record_by_email()
    {
        $this->assertEquals([], resolve(CrmInterface::class)->findByEmail('A1'));
    }

    public function test_it_can_delete_record()
    {
        $this->assertTrue(resolve(CrmInterface::class)->delete('email@email.com'));
    }
}
