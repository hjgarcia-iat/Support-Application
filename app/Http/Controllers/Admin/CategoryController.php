<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(25);

        return \view('admin.category.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return \view('admin.category.create');
    }
}
