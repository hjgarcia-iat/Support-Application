<?php

namespace Database\Seeders;

use App\Status;
use App\Ticket;
use App\User;
use Carbon\Carbon;
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
        $faker = \Faker\Factory::create(Factory::DEFAULT_LOCALE);

        User::factory()->create(['email' => 'test@email.com']);
    }
}
