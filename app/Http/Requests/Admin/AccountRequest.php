<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'min:8|numbers|letters|case_diff'
        ];

        return $rules;
    }

    public function authorize()
    {
        return true;
    }
}