<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleCreateRequest;
use App\Http\Requests\Admin\ArticleEditRequest;

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

    public function store(ArticleCreateRequest $request)
    {
        $article = Article::create([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'content' => $request->get('content'),
            'pinned' => $request->get('pinned'),
        ]);

        $article->categories()->attach(collect($request->get('categories'))->values());

        return redirect(route('admin.articles'))
            ->with('type', 'success')
            ->with('status', 'Article was created.');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();

        return view('admin.articles.edit', [
            'categories' => $categories,
            'article' => $article->load('categories')
        ]);
    }

    public function update(ArticleEditRequest $request, Article $article)
    {
        $article->update([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'content' => $request->get('content'),
            'pinned' => $request->get('pinned'),
        ]);

        $article->categories()->sync(collect($request->get('categories'))->values());

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
