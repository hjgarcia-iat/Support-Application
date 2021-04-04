<?php

namespace Tests\Feature\App\Http\Requests;

use App\Http\Requests\RequestProductInformationRequest;
use Tests\TestCase;

/**
 * Class RequestProductInformationRequestTest
 * @package Tests\Feature
 */
class RequestProductInformationRequestTest extends TestCase
{
    public function test_the_form_request_returns_the_correct_rules()
    {
        $rules = [
            'first_name'       => 'required',
            'last_name'        => 'required',
            'email'            => 'required|email',
            'role'             => 'required',
            'product_interest' => 'required',
            'school'           => 'required',
            'city'             => 'required',
            'state'            => 'required',
        ];

        $request = new RequestProductInformationRequest();

        $this->assertEquals($rules, $request->rules());
    }
}
