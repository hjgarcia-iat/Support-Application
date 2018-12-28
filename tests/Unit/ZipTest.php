<?php

namespace Tests\Unit;

use App\Zip;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class ZipTest
 * @package Tests\Unit
 */
class ZipTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;

    /**
     * @test
     */
    public function test_is_has_a_zip_code_field()
    {
        $zip = factory(Zip::class)->create(['zip_code'=> 00000]);

        $this->assertEquals(00000, $zip->zip_code);
    }

    /**
     * @test
     */
    public function test_is_has_a_city_field()
    {
        $zip = factory(Zip::class)->create(['city'=> 'city']);

        $this->assertEquals('city', $zip->city);
    }

    /**
     * @test
     */
    public function test_is_has_a_state_field()
    {
        $zip = factory(Zip::class)->create(['state'=> 'state']);

        $this->assertEquals('state', $zip->state);
    }

    /**
     * @test
     */
    public function test_is_has_an_abbr_field()
    {
        $zip = factory(Zip::class)->create(['abbr'=> 'abbr']);

        $this->assertEquals('abbr', $zip->abbr);
    }
}
