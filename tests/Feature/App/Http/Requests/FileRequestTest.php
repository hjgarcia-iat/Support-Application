<?php

namespace Tests\App\Http\Requests;

use App\Http\Requests\FileRequest;
use Tests\TestCase;

/**
 * Class FileRequestTest
 * @package Tests\Feature
 */
class FileRequestTest extends TestCase
{
    public function test_the_form_request_returns_the_correct_rules()
    {
        $rules = [
            'id'   => 'required',
            'file' => 'mimes:jpg,png,gif,pdf,doc,docx',
        ];

        $request = new FileRequest();

        $this->assertEquals($rules, $request->rules());
    }
}
