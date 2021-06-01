<?php

namespace Tests\Feature\App\Http\Requests\Admin;

use App\Category;
use App\Http\Requests\Admin\CategoryCreateRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CategoryCreateRequestTest
 * @package Tests\Feature
 */
class CategoryCreateRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_parent_id_exists()
    {
        $data = [
            'parent_id' => 1,
            'name' => 'test',
            'slug' => 'test',
        ];

        $request = new CategoryCreateRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }

    public function test_parent_id_is_not_required()
    {
        $data = [
            'name' => 'test',
            'slug' => 'test',
        ];

        $request = new CategoryCreateRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }


    public function test_name_field_is_required()
    {
        $category = Category::factory()->create();

        $data = [
            'parent_id' => $category->id,
            'slug' => 'test',
        ];

        $request = new CategoryCreateRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }

    public function test_slug_field_is_required()
    {
        $category = Category::factory()->create();
        $data = [
            'parent_id' => $category->id,
            'name' => 'name',
        ];

        $request = new CategoryCreateRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }

    public function test_slug_field_is_unique()
    {
        $category = Category::factory()->create(['slug' => 'not-unique']);

        $data = [
            'parent_id' => $category->id,
            'name' => 'name',
            'slug' => $category->slug
        ];

        $request = new CategoryCreateRequest();

        $validator = \Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }
}
