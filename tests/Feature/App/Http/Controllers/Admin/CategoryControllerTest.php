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

        $response = $this->actingAs($user)->get(\route('admin.categories'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.category.index');
        foreach($categories as $category) {
            $response->assertSee($category->id);
            $response->assertSee($category->name);
        }
    }

    public function test_as_an_admin_we_can_see_the_category_create_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(\route('admin.categories.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.category.create');
    }

    public function test_as_an_admin_we_can_see_the_category_edit_page()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(\route('admin.categories.edit', $category->id));

        $response->assertStatus(200);
        $response->assertViewIs('admin.category.edit');
        $response->assertSee($category->id);
        $response->assertSee($category->name);
        $response->assertSee($category->slug);
    }
}
