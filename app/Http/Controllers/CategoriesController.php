<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show($slug)
    {
        $category = Category::with(['children', 'articles'])
            ->whereSlug($slug)
            ->first();

        return \view('categories.show', ['category' => $category]);
    }
}
