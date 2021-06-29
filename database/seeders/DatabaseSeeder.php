<?php

namespace Database\Seeders;

use App\Article;
use App\Category;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->create([
            'name' => 'Curriculum & Product Usage',
            'slug' => 'Curriculum and Product Usage'
        ]);

        Category::factory()->create([
            'name' => 'Customer Support, Sales & Orders',
            'slug' => 'Customer Support, Sales and Orders'
        ]);

        Category::factory()->create([
            'name' => 'General Product Information',
            'slug' => 'General Product Information'
        ]);

        Category::factory()->create([
            'name' => 'LMS Integration & Rostering',
            'slug' => 'LMS Integration and Rostering'
        ]);

        Category::factory()->create([
            'name' => 'New Customer Onboarding',
            'slug' => 'New Customer Onboarding'
        ]);

        Category::factory()->create([
            'name' => 'Teacher & Student Accounts',
            'slug' => 'Teacher and Student Accounts'
        ]);

        //foreach category create 5 dummy ones.
        $categories = Category::all();

        foreach ($categories as $category) {
            Category::factory(5)->create(['parent_id' => $category->id]);
        }

        $articles = Article::factory(400)->create(['pinned' => false]);

        foreach ($articles as $article) {
            $article->categories()->attach(Category::inRandomOrder()->first());
        }

        //create 2 pinned articles
        $articleA = Article::factory()->create(['pinned' => true,'name' => 'this is the first pinned article']);
        $articleB = Article::factory()->create(['pinned' => true,'name' => 'this is the second pinned article']);
        $articleA->categories()->attach(Category::first());
        $articleB->categories()->attach(Category::first());

        User::factory()->create(['email' => 'test@email.com']);
    }
}
