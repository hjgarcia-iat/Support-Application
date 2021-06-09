<?php

namespace Tests\Feature\App\Http\Requests\Admin;

use App\Article;
use App\Category;
use App\Http\Requests\Admin\ArticleCreateRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ArticleCreateRequestTest
 * @package Tests\Feature
 */
class ArticleCreateRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_pinned_field_is_required()
    {
        $category = Category::factory()->create();
        $data = [
            'categories' => [$category->id],
            'name' => 'test',
            'slug' => 'test',
            'content' => 'test'
        ];

        $request = new ArticleCreateRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->messages()->has('pinned'));
    }

    public function test_the_pinned_field_is_valid()
    {
        $category = Category::factory()->create();
        $data = [
            'pinned' => 'invalid',
            'categories' => [$category->id],
            'name' => 'test',
            'slug' => 'test',
            'content' => 'test'
        ];

        $request = new ArticleCreateRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->messages()->has('pinned'));
    }

    public function test_the_categories_field_is_required()
    {
        $data = [
            'pinned' => 'invalid',
            'name' => 'test',
            'slug' => 'test',
            'content' => 'test'
        ];

        $request = new ArticleCreateRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->messages()->has('categories'));
    }

    public function test_the_categories_exists()
    {
        $data = [
            'pinned' => 'invalid',
            'categories' => ['does-not-exist'],
            'name' => 'test',
            'slug' => 'test',
            'content' => 'test'
        ];

        $request = new ArticleCreateRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->messages()->has('categories'));
    }


    public function test_name_field_is_required()
    {
        $category = Category::factory()->create();
        $data = [
            'pinned' => true,
            'categories' => [$category->id],
            'slug' => 'test',
            'content' => 'test'
        ];

        $request = new ArticleCreateRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->messages()->has('name'));
    }

    public function test_slug_field_is_required()
    {
        $category = Category::factory()->create();
        $data = [
            'pinned' => true,
            'categories' => [$category->id],
            'name' => 'test',
            'content' => 'test'
        ];

        $request = new ArticleCreateRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->messages()->has('slug'));
    }

    public function test_slug_field_is_unique()
    {
        $category = Category::factory()->create();
        $article = Article::factory()->create();
        $data = [
            'pinned' => true,
            'categories' => [$category->id],
            'name' => 'test',
            'slug' => $article->slug,
            'content' => 'test'
        ];

        $request = new ArticleCreateRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->messages()->has('slug'));
    }

    public function test_the_content_field_required()
    {
        $category = Category::factory()->create();
        $data = [
            'pinned' => true,
            'categories' => [$category->id],
            'name' => 'test',
            'slug' => 'test',
        ];

        $request = new ArticleCreateRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->messages()->has('content'));
    }

}
