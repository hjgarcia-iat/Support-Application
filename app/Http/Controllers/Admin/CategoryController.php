<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Http\Requests\Admin\CategoryEditRequest;

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

    public function store(CategoryCreateRequest $request)
    {
        Category::create([
            'parent_id' => ($request->has('parent_id')) ? $request->get('parent_id') : null,
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
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

    public function update(CategoryEditRequest $request, Category $category)
    {
        $category->update([
            'parent_id' => $request->get('parent_id'),
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
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
                ->with('status', 'Category cannot be deleted. There are articles associated to it.');
        }

        if ($category->children()->exists()) {
            return redirect(route('admin.categories'))
                ->with('type', 'info')
                ->with('status', 'Category cannot be deleted. There are categories associated to it.');
        }

        $category->delete();

        return redirect(route('admin.categories'))
            ->with('type', 'success')
            ->with('status', 'Category was deleted.');
    }
}
