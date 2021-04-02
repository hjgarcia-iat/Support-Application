<?php

namespace Tests\Unit\Models;

use App\Services\CrmInterface;
use Tests\TestCase;

class CrmFakeTest extends TestCase
{
    public function test_it_can_get_a_record_by_email()
    {
        $data = [
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jdoe@email.com',
        ];

        resolve(CrmInterface::class)->store($data);

        $this->assertEquals($data, resolve(CrmInterface::class)->findByEmail($data['email']));
    }

    public function test_it_can_delete_record()
    {
        $data = [
            'first_name' => 'Jane',
            'last_name'  => 'Doe',
            'email'      => 'jdoe@email.com',
        ];

        resolve(CrmInterface::class)->store($data);

        $this->assertTrue(resolve(CrmInterface::class)->delete($data['email']));
    }

    public function test_we_get_false_if_we_try_to_delete_a_record_that_does_not_exist()
    {
        $this->assertFalse(resolve(CrmInterface::class)->delete('email@email.com'));
    }
}
