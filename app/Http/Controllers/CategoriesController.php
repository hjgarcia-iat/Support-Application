<?php

namespace App\Http\Controllers;

use App\Category;

class CategoriesController extends Controller
{
    public function show($slug)
    {
        $category = Category::with(['children','articles'])
            ->whereSlug($slug)
            ->firstOrFail();

        return view('categories.show',['category' => $category]);
    }
}
