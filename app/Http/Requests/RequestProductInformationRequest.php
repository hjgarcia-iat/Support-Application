<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProductInformationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name'       => 'required',
            'last_name'        => 'required',
            'email'            => 'required|email',
            'role'             => 'required',
            'product_interest' => 'required',
            'school'           => 'required',
            'city'             => 'required',
            'state'            => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}