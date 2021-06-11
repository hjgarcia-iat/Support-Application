<?php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Category;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('categories', function (BreadcrumbTrail $trail, Category $category) {
    $trail->parent('home');
    $trail->push($category->name, route('categories.show', $category->slug));
});

Breadcrumbs::for('articles', function (BreadcrumbTrail $trail, Category $category) {
    if ($category->parent) {
        $trail->parent('categories', $category->parent);
    } else {
        $trail->parent('home');
    }

    $trail->push($category->name, route('categories.show', $category->slug));
});
