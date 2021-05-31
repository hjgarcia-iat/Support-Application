<?php

namespace Database\Factories;

use App\Article;
use App\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'category_id' => function () {
                return Category::factory()->create()->id;
            }
        ];
    }
}
