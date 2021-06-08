<?php

namespace Database\Factories;

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence;
        return [
            'name' => $name,
            'slug' => Str::slug($name)
        ];
    }
}
