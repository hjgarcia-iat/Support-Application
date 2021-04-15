<?php

namespace Database\Seeders;

use App\Status;
use App\Ticket;
use App\User;
use Carbon\Carbon;
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
        User::factory()->create(['email' => 'test@email.com']);

        Status::factory()->create(['type' => 'High', 'created_at' => Carbon::now()->subMonth()]);
        Status::factory()->create(['type' => 'Default', 'created_at' => Carbon::now()->subDays(6), 'post' => 'All Systems Operational.']);
        Status::factory()->create(['type' => 'Medium', 'created_at' => Carbon::now()->subDays(5)]);
        Status::factory()->create(['type' => 'Default', 'created_at' => Carbon::now()->subDays(5), 'post' => 'All Systems Operational.']);
        Status::factory()->create(['type' => 'Default', 'created_at' => Carbon::now()->subDays(4), 'post' => 'All Systems Operational.']);
        Status::factory()->create(['type' => 'Default', 'created_at' => Carbon::now()->subDays(3), 'post' => 'All Systems Operational.']);
        Status::factory()->create(['type' => 'Low', 'created_at' => Carbon::now()->subDays(2)]);
        Status::factory()->create(['type' => 'Default', 'created_at' => Carbon::now()->subDays(2), 'post' => 'All Systems Operational.']);
        Status::factory()->create(['type' => 'Low', 'created_at' => Carbon::now()->subDays(1)]);
        Status::factory()->create(['type' => 'Default', 'created_at' => Carbon::now()->subDays(1), 'post' => 'All Systems Operational.']);
        Status::factory()->create(['type' => 'Default', 'post' => 'All Systems Operational.']);

        Ticket::factory(50)->create();
    }
}
