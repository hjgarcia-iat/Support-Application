<?php

namespace Tests\Unit;

use App\Refund;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RefundTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @test
     */
    public function it_has_a_name_field()
    {
        $refund = factory(Refund::class)->create(['name' => 'John Doe']);

        $this->assertEquals('John Doe', $refund->name);
    }

    /**
     * @test
     */
    public function it_has_an_email_field()
    {
        $refund = factory(Refund::class)->create(['email' => 'jdoe@email.com']);

        $this->assertEquals('jdoe@email.com', $refund->email);
    }

    /**
     * @test
     */
    public function it_has_a_district_field()
    {
        $refund = factory(Refund::class)->create(['district' => 'some district']);

        $this->assertEquals('some district', $refund->district);
    }

    /**
     * @test
     */
    public function it_has_an_order_number_field()
    {
        $refund = factory(Refund::class)->create(['order_number' => '12fef4523']);

        $this->assertEquals('12fef4523', $refund->order_number);
    }

    /**
     * @test
     */
    public function it_has_a_reason_field()
    {
        $refund = factory(Refund::class)->create(['reason' => 'some reason']);

        $this->assertEquals('some reason', $refund->reason);
    }

    /**
     * @test
     */
    public function it_has_an_rma_number_field()
    {
        $refund = factory(Refund::class)->create(['rma_number' => 'some rma number']);

        $this->assertEquals('some rma number', $refund->rma_number);
    }
}