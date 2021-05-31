<?php

namespace Database\Factories;

use App\Article;
use App\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word;

        return [
            'category_id' => function () {
                return Category::factory()->create()->id;
            },
            'name' => $name,
            'slug' => Str::slug($name),
            'content' => $this->faker->paragraph,
            'views' => $this->faker->randomDigit,
            'pinned' => $this->faker->boolean,
            'rating' => $this->faker->randomElement([0, 1, 2, 3, 4, 5]),
        ];
    }
}
