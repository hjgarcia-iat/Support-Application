<?php

namespace Tests\Feature\App\Http\Requests\Admin;

use App\Article;
use App\Category;
use App\Http\Requests\Admin\ArticleEditRequest;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
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
        $category->articles()->attach($article);
        $user = User::factory()->create();
        $data = [
            'pinned' => true,
            'categories' => [$category->id],
            'name' => 'test',
            'slug' => $article->slug,
            'content' => 'test'
        ];

        $response = $this->actingAs($user)->patch(\route('admin.articles.update', $article), $data);

        $response->assertRedirect(\route('admin.articles.edit', $article));
        $response->assertSessionDoesntHaveErrors();
        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'pinned' => $data['pinned'],
            'name' => $data['name'],
            'slug' => $article->slug,
            'content' => $data['content']
        ]);
    }


    public function test_slug_field_is_unique()
    {
        $category = Category::factory()->create();
        $articleA = Article::factory()->create();
        $articleB = Article::factory()->create();
        $category->articles()->attach($articleA);
        $category->articles()->attach($articleB);
        $user = User::factory()->create();
        $data = [
            'pinned' => true,
            'categories' => [$category->id],
            'name' => 'test',
            'slug' => $articleB->slug,
            'content' => 'test'
        ];

        $response = $this->actingAs($user)
            ->from(\route('admin.articles.edit', $articleA))
            ->patch(\route('admin.articles.update', $articleA), $data);

        $response->assertRedirect(\route('admin.articles.edit', $articleA));
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('articles', [
            'id' => $articleA->id,
            'pinned' => $data['pinned'],
            'name' => $data['name'],
            'slug' => $articleA->slug,
            'content' => $data['content']
        ]);
    }
}
