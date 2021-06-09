<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'pinned' => ['required', 'boolean'],
            'categories' => ['required','exists:categories,id'],
            'name' => ['required'],
            'slug' => ['required', 'unique:articles']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
