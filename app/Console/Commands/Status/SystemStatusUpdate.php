<?php

namespace App\Console\Commands\Status;

use App\Status;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SystemStatusUpdate extends Command
{
    protected $signature = 'system-status:update';

    protected $description = 'Post a system status update.';

    public function handle()
    {
        $currentPosts = Status::whereDate('created_at',Carbon::today())->get();

        if($currentPosts->count() === 0) {
            Status::create([
                'type' => Status::DEFAULT,
                'post' => 'All systems operational.'
            ]);
        }
    }
}
