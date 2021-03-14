<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'required',
            'file' => 'mimes:jpg,png,gif,pdf,doc,docx',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
