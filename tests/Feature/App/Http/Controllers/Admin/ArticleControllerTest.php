<?php

namespace Tests\Feature\App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ArticleControllerTest
 * @package Tests\Feature
 */
class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_as_an_admin_we_can_see_all_articles_in_the_articles_index_page()
    {
        $articles = Article::factory(3)->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.articles'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.articles.index');
        foreach ($articles as $article) {
            $response->assertSee($article->id);
            $response->assertSee($article->name);
        }
    }

    public function test_as_an_admin_we_can_see_the_article_create_page()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.articles.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.articles.create');
        $response->assertSee($category->id);
        $response->assertSee($category->name);
    }

    public function test_as_admin_we_can_store_an_article()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $data = [
            'category_id' => $category->id,
            'name' => 'test',
            'slug' => 'test',
            'content' => 'test',
            'pinned' => true
        ];

        $response = $this->actingAs($user)->post(route('admin.articles.store'), $data);

        $response->assertRedirect(route('admin.articles'));
        $this->assertDatabaseHas('articles', $data + ['views' => 0, 'rating' => 0]);
    }

    public function test_as_an_admin_we_can_see_the_article_edit_page()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $article = Article::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.articles.edit', $article));

        $response->assertStatus(200);
        $response->assertViewIs('admin.articles.edit');
        $response->assertSee($category->id);
        $response->assertSee($category->name);
        $response->assertSee($article->id);
        $response->assertSee($article->name);
        $response->assertSee($article->slug);
        $response->assertSee($article->content);
        $response->assertSee($article->pinned);
        $response->assertSee($article->views);
        $response->assertSee($article->rating);
    }

    public function test_as_an_admin_we_update_an_article()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $article = Article::factory()->create(['rating' => 0, 'views' => 0]);
        $data = [
            'category_id' => $category->id,
            'name' => 'test',
            'slug' => 'test',
            'content' => 'test',
            'pinned' => true
        ];

        $response = $this->actingAs($user)->patch(route('admin.articles.edit', $article), $data);

        $response->assertRedirect(route('admin.articles.edit', $article));
        $this->assertDatabaseHas('articles', $data + ['views' => 0, 'rating' => 0, 'id' => $article->id]);
    }

    public function test_as_an_admin_we_can_delete_an_article()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.articles.delete', $article));

        $response->assertRedirect(route('admin.articles'));
        $this->assertDatabaseMissing('articles', [
            'id' => $article->id
        ]);
    }
}
