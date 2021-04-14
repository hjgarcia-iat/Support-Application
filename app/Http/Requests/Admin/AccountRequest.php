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
        ];

        return $rules;
    }

    public function authorize()
    {
        return true;
    }
}