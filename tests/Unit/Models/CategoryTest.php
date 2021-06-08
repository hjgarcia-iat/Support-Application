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
            'parent_id' => 1,
            'name' => 'name',
            'slug' => 'slug',
        ];

        $category = Category::factory()->create($data);

        $this->assertEquals($data['parent_id'], $category->fresh()->parent_id);
        $this->assertEquals($data['name'], $category->fresh()->name);
        $this->assertEquals($data['slug'], $category->fresh()->slug);
    }


    public function test_it_can_have_a_category_as_a_parent_relationship()
    {
        $categoryA = Category::factory()->create();
        $categoryB = Category::factory()->create(['parent_id' => $categoryA->id]);

        $this->assertEquals($categoryA->id, $categoryB->parent->id);
    }

    public function test_it_can_have_categories_as_children_relationship()
    {
        $categoryA = Category::factory()->create();
        $categoryB = Category::factory()->create(['parent_id' => $categoryA->id]);
        $categoryC = Category::factory()->create(['parent_id' => $categoryA->id]);

        $this->assertEquals($categoryB->id, $categoryA->children()->where('id', $categoryB->id)->first()->id);
        $this->assertEquals($categoryC->id, $categoryA->children()->where('id', $categoryC->id)->first()->id);
    }

    public function test_it_has_a_many_to_many_relationship_to_articles()
    {
        $category = Category::factory()->create();
        $article = Article::factory()->create();

        $category->articles()->attach($article);

        $this->assertInstanceOf(Article::class, $category->articles->first());
    }
}
