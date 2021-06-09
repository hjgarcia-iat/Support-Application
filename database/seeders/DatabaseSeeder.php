<?php

namespace Database\Seeders;

use App\Category;
use App\User;
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

        User::factory()->create(['email' => 'test@email.com']);
    }
}
