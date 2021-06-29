<?php

namespace App\Http\Controllers;

use App\Category;

class SearchController extends Controller
{
    public function index()
    {
        //when we search we only want subcategories not root
        $categories = Category::where('parent_id', '<>', null)
            ->where('name','LIKE','%'. request('q') .'%')
            ->paginate(20);

        return view('search.index', ['categories' => $categories]);
    }
}
