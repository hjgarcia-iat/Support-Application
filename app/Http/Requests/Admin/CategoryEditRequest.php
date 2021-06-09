<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryEditRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required'],
            'slug' => ['required', 'unique:categories,slug,' . $this->route()->parameter('category')->id],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
