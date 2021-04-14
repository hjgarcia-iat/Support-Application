<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StatusRequest extends FormRequest
{
    public function rules()
    {
        return [
            'post'=> ['required'],
            'type'=> ['required',  Rule::in(['Default','Low','Medium','High']),]
        ];
    }

    public function authorize()
    {
        return true;
    }
}