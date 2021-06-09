<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'parent_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required'],
            'slug' => ['required', 'unique:categories,slug'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
