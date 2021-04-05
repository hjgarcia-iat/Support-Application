<?php

namespace Tests\Feature\App\Http\Requests;

use App\Http\Requests\FileRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Class FileRequestTest
 * @package Tests\Feature
 */
class FileRequestTest extends TestCase
{
    public function test_it_passes_with_valid_data()
    {
        $request = new FileRequest();
        Storage::fake('s3');
        $file = UploadedFile::fake()->image('image.jpg');

        $validator = \Validator::make([
            'id' => 1,
            'file'   => $file,
        ], $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function test_the_id_required()
    {
        $request = new FileRequest();
        Storage::fake('s3');
        $file = UploadedFile::fake()->image('image.jpg');

        $validator = \Validator::make([
            'file'   => $file,
        ], $request->rules());

        $this->assertFalse($validator->passes());
    }

    public function test_the_file_of_valid_type()
    {
        $request = new FileRequest();
        Storage::fake('s3');
        $jpg = UploadedFile::fake()->image('image.jpg');
        $png = UploadedFile::fake()->image('image.png');
        $gif = UploadedFile::fake()->image('image.gif');
        $doc = UploadedFile::fake()->create('doc.doc');
        $docx = UploadedFile::fake()->create('doc.docx');
        $pdf = UploadedFile::fake()->create('file.pdf');

        $jpgValidate = \Validator::make([
            'id' => 1,
            'file'   => $jpg,
        ], $request->rules());

        $pngValidate = \Validator::make([
            'id' => 1,
            'file'   => $png,
        ], $request->rules());

        $gifValidate = \Validator::make([
            'id' => 1,
            'file'   => $gif,
        ], $request->rules());

        $docValidate = \Validator::make([
            'id' => 1,
            'file'   => $doc,
        ], $request->rules());

        $docxValidate = \Validator::make([
            'id' => 1,
            'file'   => $docx,
        ], $request->rules());

        $pdfValidate = \Validator::make([
            'id' => 1,
            'file'   => $pdf,
        ], $request->rules());


        $this->assertTrue($jpgValidate->passes());
        $this->assertTrue($pngValidate->passes());
        $this->assertTrue($gifValidate->passes());
        $this->assertTrue($docValidate->passes());
        $this->assertTrue($docxValidate->passes());
        $this->assertTrue($pdfValidate->passes());
    }

    public function test_it_fails_for_invalid_image_type()
    {
        $request = new FileRequest();
        Storage::fake('s3');
        $invalidFile = UploadedFile::fake()->create('file.xls');

        $validator = \Validator::make([
            'id' => 1,
            'file'   => $invalidFile,
        ], $request->rules());

        $this->assertFalse($validator->passes());
    }
}
