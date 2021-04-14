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

        if($this->get('password') !== null) {
            $rules['password'] = 'min:8|numbers|letters|case_diff|confirmed';
        }

        return $rules;
    }

    public function authorize()
    {
        return true;
    }
}