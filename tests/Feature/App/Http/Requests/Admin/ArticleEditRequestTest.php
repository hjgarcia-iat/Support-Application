<?php

namespace Tests\Feature\App\Http\Requests\Admin;

use App\Article;
use App\Category;
use App\Http\Requests\Admin\ArticleEditRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;

/**
 * Class ArticleEditRequestTest
 * @package Tests\Feature
 */
class ArticleEditRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_validation_if_slug_is_the_same()
    {
        $category = Category::factory()->create();
        $article = Article::factory()->create();
        $route = route('admin.articles.update', $article);
        $data = [
            'pinned' => true,
            'categories' => [$category->id],
            'name' => 'test',
            'slug' => $article->slug,
            'content' => 'test'
        ];

        $request = ArticleEditRequest::create($route, 'PATCH', $data);

        $request->setRouteResolver(function () use ($request) {
            $routes = Route::getRoutes();

            return $routes->match($request);
        });

        $validator = \Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }


    public function test_slug_field_is_unique()
    {
        $category = Category::factory()->create();
        $articleA = Article::factory()->create();
        $articleB = Article::factory()->create();
        $route = route('admin.articles.update', $articleA);
        $data = [
            'pinned' => true,
            'categories' => [$category->id],
            'name' => 'test',
            'slug' => $articleB->slug,
            'content' => 'test'
        ];

        $request = ArticleEditRequest::create($route, 'PATCH', $data);

        $request->setRouteResolver(function () use ($request) {
            $routes = Route::getRoutes();

            return $routes->match($request);
        });

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->messages()->has('slug'));
    }
}
