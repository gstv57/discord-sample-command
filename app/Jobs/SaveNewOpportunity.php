<?php
namespace App\Jobs;

use App\Models\Opportunity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Queue\Queueable;

class SaveNewOpportunity implements ShouldQueue
{
    use Queueable;

    public function __construct(public array $data)
    {
        //
    }

    public function handle(): void
    {
        try {
            Opportunity::create($this->data);
        } catch (UniqueConstraintViolationException $e) {
        }
    }
}
