<?php

namespace App\Http\Requests\Admin;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email'
        ];

        if ($this->route()->hasParameter('user')) {
            $rules['email'] = [
                'required',
                'email',
                Rule::unique('users')->ignore($this->route()->parameter('user')->id)];
        }

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