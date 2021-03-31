<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculatorRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email',
            'role'       => 'required',
            'school'     => 'required',
            'city'       => 'required',
            'state'      => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}