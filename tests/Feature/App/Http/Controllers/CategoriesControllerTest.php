<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CategoriesControllerTest
 * @package Tests\Feature
 */
class CategoriesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_as_a_user_we_can_see_the_single_categories()
    {
        $categoryA = Category::factory()->create();
        $categoryB = Category::factory()->create(['parent_id' => $categoryA->id]);
        $categoryC = Category::factory()->create(['parent_id' => $categoryA->id]);
        $articles = Article::factory(3)->create();
        $categoryA->articles()->attach($articles->pluck('id'));

        $response = $this->get(route('categories.articles.show', $categoryA->slug));

        $response->assertOk();
        $response->assertSee($categoryA->name);
        $response->assertSee($categoryB->name);
        $response->assertSee($categoryC->name);
        foreach ($articles as $article) {
            $response->assertSee($article->name);
        }
    }

    public function test_as_a_user_we_see_a_404_error_if_category_does_not_exist()
    {
        $response = $this->get(route('categories.articles.show', 'does-not-exist'));

        $response->assertStatus(404);
    }
}
