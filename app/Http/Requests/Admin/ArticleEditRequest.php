<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleEditRequest extends FormRequest
{
    public function rules()
    {
        return [
            'pinned' => ['required', 'boolean'],
            'categories' => ['required', 'exists:categories,id'],
            'name' => ['required'],
            'slug' => ['required', 'unique:articles,slug,' . $this->route()->parameter('article')]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
