<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['children', 'articles', 'parent'])->paginate(25);

        return view('admin.category.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.category.create', [
            'categories' => $categories,
        ]);
    }

    public function store()
    {
        Category::create([
            'parent_id' => (request()->has('parent_id')) ? request('parent_id') : null,
            'name' => request('name'),
            'slug' => request('slug'),
        ]);

        return redirect(route('admin.categories'))
            ->with('type', 'success')
            ->with('status', 'Category was created.');
    }

    public function edit(Category $category)
    {
        $categories = Category::all();

        return view('admin.category.edit', [
            'category' => $category,
            'categories' => $categories
        ]);
    }

    public function update(Category $category)
    {
        $category->update([
            'parent_id' => request('parent_id'),
            'name' => request('name'),
            'slug' => request('slug'),
        ]);

        return redirect(route('admin.categories.edit', $category))
            ->with('type', 'success')
            ->with('status', 'Category was updated.');
    }

    public function delete(Category $category)
    {
        if ($category->articles()->exists()) {
            return redirect(route('admin.categories'))
                ->with('type', 'info')
                ->with('status', 'Category was not deleted. There are articles associated to it.');
        }

        if ($category->children()->exists()) {
            return redirect(route('admin.categories'))
                ->with('type', 'info')
                ->with('status', 'Category was not deleted. There are categories associated to it.');
        }

        $category->delete();

        return redirect(route('admin.categories'))
            ->with('type', 'success')
            ->with('status', 'Category was deleted.');
    }
}
