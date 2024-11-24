<?php

namespace App\Jobs;

use App\Models\Opportunity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateLastSend implements ShouldQueue
{
    use Queueable;
    public function __construct(public array $jobs)
    {
        //
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Opportunity::whereIn('id', $this->jobs)->chunk(30, function ($opportunities) {
            foreach ($opportunities as $opportunity) {
                $opportunity->update(['last_sent_at' => now()]);
            }
        });
    }
}
