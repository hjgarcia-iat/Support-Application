<?php

namespace App\Console\Commands\Status;

use App\Status;
use Illuminate\Console\Command;

class SystemStatusUpdate extends Command
{
    protected $signature = 'system-status:update';

    protected $description = 'Post a system status update.';

    public function handle()
    {
        $currentPosts = Status::where('created_at',now())->get();

        if($currentPosts->count() === 0) {
            Status::create([
                'type' => Status::DEFAULT,
                'post' => 'All systems operational.'
            ]);
        }
    }
}
