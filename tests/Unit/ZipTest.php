<?php

namespace Tests\Unit;

use App\Zip;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ZipTest
 * @package Tests\Unit
 */
class ZipTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_the_correct_fields()
    {
        $data = [
            'zip_code' => 00000,
            'city' => 'city',
            'state' => 'state',
            'abbr' => 'abbr'
           
        ];

        Zip::factory()->create($data);

        $this->assertDatabaseHas('zipcodes', $data);
    }

}
