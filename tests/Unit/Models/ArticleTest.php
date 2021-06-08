<?php

namespace Tests\Unit\Models;

use App\Article;
use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_all_the_correct_fields()
    {
        $data = [
            'name' => 'name',
            'slug' => 'name',
            'content' => 'content',
            'views' => 5,
            'pinned' => false,
            'rating' => 5,
        ];

        $article = Article::factory()->create($data);

        $this->assertEquals($data['name'], $article->fresh()->name);
        $this->assertEquals($data['slug'], $article->fresh()->slug);
        $this->assertEquals($data['content'], $article->fresh()->content);
        $this->assertEquals($data['views'], $article->fresh()->views);
        $this->assertEquals($data['pinned'], $article->fresh()->pinned);
        $this->assertEquals($data['rating'], $article->fresh()->rating);
    }

    public function test_it_has_a_many_to_many_relationship_to_categories()
    {
        $category = Category::factory()->create();
        $article  = Article::factory()->create();

        $article->categories()->attach($category);

        $this->assertInstanceOf(Category::class, $article->categories->first());
    }
}
