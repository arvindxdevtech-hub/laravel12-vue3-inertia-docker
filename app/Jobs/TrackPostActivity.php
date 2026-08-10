<?php

namespace App\Jobs;

use App\Models\ActivityLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TrackPostActivity implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $type,
        public int $postId,
        public string $message
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        ActivityLog::create([
            'type' => $this->type,
            'message' => $this->message,
            'post_id' => $this->postId,
        ]);
    }
}
