<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CategoryControllerTest
 * @package Tests\Feature
 */
class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_as_a_user_we_can_see_the_show_category_page()
    {
        $categoryA = Category::factory()->create();
        $categoryB = Category::factory()->create(['parent_id' => $categoryA->id]);
        $articles = Article::factory(5)->create();

        foreach($articles as $article) {
            $article->categories()->attach($categoryA);
        }

        $response = $this->get(\route('article.show', $categoryA->slug));

        $response->assertOk();
        $response->assertSee($categoryA->name);
        $response->assertSee($categoryB->name);
        foreach($articles as $article) {
            $response->assertSee($article->name);
        }
    }
}
