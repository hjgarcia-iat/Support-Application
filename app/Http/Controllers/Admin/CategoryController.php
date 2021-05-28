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

    public function store()
    {
        Category::create([
            'name' => request('name'),
            'slug' => request('slug'),
        ]);

        return redirect(route('admin.categories'))
            ->with('type', 'success')
            ->with('status', 'Category was created.');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'category' => $category
        ]);
    }

    public function update(Category $category)
    {
        $category->update([
            'name' => request('name'),
            'slug' => request('slug'),
        ]);

        return redirect(route('admin.categories.edit', $category))
            ->with('type', 'success')
            ->with('status', 'Category was updated.');
    }

    public function delete(Category $category)
    {
        $category->delete();

        return redirect(route('admin.categories'))
            ->with('type', 'success')
            ->with('status', 'Category was deleted.');
    }
}
