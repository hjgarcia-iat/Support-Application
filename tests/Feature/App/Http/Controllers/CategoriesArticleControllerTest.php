<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CategoriesArticleControllerTest
 * @package Tests\Feature
 */
class CategoriesArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_as_a_user_we_can_see_the_single_article()
    {
        $categoryA = Category::factory()->create();
        $categoryB = Category::factory()->create(['parent_id' => $categoryA->id]);
        $categoryC = Category::factory()->create(['parent_id' => $categoryA->id]);
        $article   = Article::factory()->create(['pinned' => false]);
        $categoryA->articles()->attach($article);

        $response = $this->get(route('categories.articles.show', [$categoryA->slug, $article->slug]));

        $response->assertOk();
        $response->assertSee($categoryA->name);
        $response->assertSee($categoryB->name);
        $response->assertSee($categoryC->name);
        $response->assertSee($article->name);
    }

    public function test_as_a_user_we_see_a_404_error_if_category_does_not_exist()
    {
        $article  = Article::factory()->create();
        $response = $this->get(route('categories.articles.show', ['does-not-exist', $article->slug]));

        $response->assertStatus(404);
    }

    public function test_as_a_user_we_see_a_404_error_if_article_does_not_exist()
    {
        $category = Category::factory()->create();
        $response = $this->get(route('categories.articles.show', [$category->slug, 'does-not-exist']));

        $response->assertStatus(404);
    }

}
