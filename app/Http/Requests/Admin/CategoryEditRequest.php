<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryEditRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'parent_id' => ['sometimes', 'exists:categories,id'],
            'name' => ['required'],
            'slug' => ['required', 'unique:categories,slug,' . $this->route()->parameter('id')],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
