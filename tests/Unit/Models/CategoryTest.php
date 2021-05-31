<?php

namespace Tests\Unit\Models;

use App\Article;
use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_the_correct_fields()
    {
        $data = [
            'name' => 'John Doe',
            'slug' => 'jdoe@email.com',
        ];

        $category = Category::factory()->create($data);

        $this->assertEquals($data['name'], $category->fresh()->name);
        $this->assertEquals($data['slug'], $category->fresh()->slug);
    }

    public function test_it_has_a_many_to_many_relationship_to_articles()
    {
        $category = Category::factory()->create();
        $article  = Article::factory()->create();

        $category->articles()->attach($article);

        $this->assertInstanceOf(Article::class, $category->articles->first());
    }
}
