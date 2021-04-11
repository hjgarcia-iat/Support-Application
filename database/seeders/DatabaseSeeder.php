<?php

namespace Database\Seeders;

use App\Status;
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
        Status::factory()->create(['type' => 'High', 'created_at' => Carbon::now()->subMonth()]);
        Status::factory()->create(['type' => 'Medium', 'created_at' => Carbon::now()->subDays(5)]);
        Status::factory()->create(['type' => 'Low', 'created_at' => Carbon::now()->subDays(2)]);
    }
}
