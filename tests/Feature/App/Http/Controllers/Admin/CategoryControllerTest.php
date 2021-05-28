<?php

namespace Tests\Feature\App\Http\Controllers\Admin;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CategoryControllerTest
 * @package Tests\Feature
 */
class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_as_an_admin_we_can_see_all_categories_in_the_categories_index_page()
    {
        $categories = Category::factory(3)->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.categories'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.category.index');
        foreach ($categories as $category) {
            $response->assertSee($category->id);
            $response->assertSee($category->name);
        }
    }

    public function test_as_an_admin_we_can_see_the_category_create_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.categories.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.category.create');
    }

    public function test_as_admin_we_can_store_a_category()
    {
        $user = User::factory()->create();
        $data = [
            'name' => 'test',
            'slug' => 'test'
        ];

        $response = $this->actingAs($user)->post(route('admin.categories.store'), $data);

        $response->assertRedirect(route('admin.categories'));
        $this->assertDatabaseHas('categories', [
            'name' => 'test',
            'slug' => 'test'
        ]);
    }

    public function test_as_an_admin_we_can_see_the_category_edit_page()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.categories.edit', $category->id));

        $response->assertStatus(200);
        $response->assertViewIs('admin.category.edit');
        $response->assertSee($category->id);
        $response->assertSee($category->name);
        $response->assertSee($category->slug);
    }

    public function test_as_an_admin_we_can_update_a_category()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();
        $data = [
            'name' => 'test',
            'slug' => 'test'
        ];

        $response = $this->actingAs($user)->patch(route('admin.categories.update', $category->id), $data);

        $response->assertRedirect(route('admin.categories.edit', $category->id));
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'test',
            'slug' => 'test'
        ]);
    }

    public function test_as_admin_we_can_delete_a_category()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.categories.delete', $category->id));

        $response->assertRedirect(route('admin.categories'));
        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
            'name' => 'test',
            'slug' => 'test'
        ]);
    }
}
