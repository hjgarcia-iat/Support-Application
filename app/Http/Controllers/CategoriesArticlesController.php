<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;

class CategoriesArticlesController extends Controller
{
    public function show($slug, $articleSlug)
    {
        $category = Category::with(['children', 'parent'])
                            ->whereSlug($slug)
                            ->firstOrFail();
        $article  = Article::whereSlug($articleSlug)->firstOrFail();

        return view('categories.articles.show', [
            'category' => $category,
            'article' => $article,
        ]);
    }
}
