<?php

namespace Tests\Feature\App\Http\Requests;

use App\Http\Requests\CalculatorRequest;
use Tests\TestCase;

/**
 * Class CalculatorRequestTest
 * @package Tests\Feature
 */
class CalculatorRequestTest extends TestCase
{
    public function test_the_form_request_returns_the_correct_rules()
    {
        $rules = [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email',
            'role'       => 'required',
            'school'     => 'required',
            'city'       => 'required',
            'state'      => 'required',
        ];

        $request = new CalculatorRequest();

        $this->assertEquals($rules, $request->rules());
    }
}
