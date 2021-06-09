<?php

namespace App\Http\Controllers;

use App\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::root()->get();

        return view('home.index', ['categories' => $categories]);
    }
}
