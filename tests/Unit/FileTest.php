<?php

namespace Tests\Unit;

use App\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FileTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_the_correct_fields()
    {
        $data = [
            'contact_id' => 1,
            'file' => 'image.jpg',
        ];

        File::factory()->create($data);

        $this->assertDatabaseHas('files', $data);
    }
}
