<?php

namespace Tests\Feature\App\Http\Requests\Admin;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CategoryEditRequestTest
 * @package Tests\Feature
 */
class CategoryEditRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_we_can_update_a_category_if_the_pass_the_same_slug_from_the_same_category()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $data = [
            'parent_id' => null,
            'name' => 'name',
            'slug' => $category->slug
        ];

        $response = $this->actingAs($user)
            ->from(route('admin.categories.edit', $category))
            ->patch(route('admin.categories.update', $category), $data);

        $response->assertRedirect(route('admin.categories.edit', $category));
        $response->assertSessionDoesntHaveErrors();
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'parent_id' => null,
            'name' => $data['name'],
            'slug' => $data['slug'],
        ]);
    }
}
