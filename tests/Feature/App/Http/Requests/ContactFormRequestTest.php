<?php

namespace Tests\Feature\App\Http\Requests;

use App\Http\Requests\ContactFormRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ContactFormRequestTest
 * @package Tests\Feature
 */
class ContactFormRequestTest extends TestCase
{
    public function test_the_form_request_returns_the_correct_rules()
    {
        $rules = [
            'reason'   => 'required',
            'name'     => 'required',
            'email'    => 'required|email',
            'district' => 'required',
            'subject'  => 'required',
            'details'  => 'required',
        ];

        $request = new ContactFormRequest();

        $this->assertEquals($rules, $request->rules());
    }
}
