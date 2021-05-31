<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(25);

        return view('admin.articles.index', [
            'articles' => $articles,
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.articles.create', [
            'categories' => $categories,
        ]);
    }

    public function store()
    {
        Article::create([
            'category_id' => request('category_id'),
            'name' => request('name'),
            'slug' => request('slug'),
            'content' => request('content'),
            'pinned' => request('pinned'),
        ]);


        return redirect(route('admin.articles'))
            ->with('type', 'success')
            ->with('status', 'Article was created.');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();

        return view('admin.articles.edit', [
            'categories' => $categories,
            'article' => $article
        ]);
    }

    public function update(Article $article)
    {
        $article->update([
            'category_id' => request('category_id'),
            'name' => request('name'),
            'slug' => request('slug'),
            'content' => request('content'),
            'pinned' => request('pinned'),
        ]);

        return redirect(route('admin.articles.edit', $article))
            ->with('type', 'success')
            ->with('status', 'Article was updated.');
    }

    public function delete(Article $article)
    {
        $article->delete();

        return redirect(route('admin.articles'))
            ->with('type', 'success')
            ->with('status', 'Article was deleted.');
    }
}
