<?php

namespace Tests\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Class ContactControllerTest
 * @package Tests\Feature
 */
class ContactControllerTest extends TestCase
{
    use RefreshDatabase;


    public function test_we_can_post_a_file()
    {
        Storage::fake('s3');
        $file = UploadedFile::fake()->image('image.jpg');


        $response = $this->post(route('files.store'), [
            'id' => 1,
            'file' => $file,
        ]);


        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        Storage::disk('s3')->assertExists("contact-request/{$file->hashName()}");

        $this->assertDatabaseHas('files', [
            'contact_id' => 1,
            'file'       => $file->hashName(),
        ]);
    }
}
