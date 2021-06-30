<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;

class SearchController extends Controller
{
    public function index()
    {
        //it needs to look through articles
        $articles = Article::where('name','LIKE','%'. request('q') .'%')
            ->paginate(20);

        return view('search.index', ['articles' => $articles]);
    }
}
