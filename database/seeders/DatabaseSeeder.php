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

        for ($i = 0; $i < 50; $i++) {
            Status::factory()->create([
                'type'       => $faker->randomElement(['Low', 'Default', 'Medium', 'High']),
                'created_at' => Carbon::today()->subDays(rand(0, 365)),
            ]);
        }



        Ticket::factory(50)->create();
    }
}
