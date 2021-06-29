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
        $title = $this->faker->sentence;

        return [
            'name' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraph,
            'views' => $this->faker->randomDigit,
            'pinned' => $this->faker->boolean,
            'rating' => 3,
        ];
    }
}
