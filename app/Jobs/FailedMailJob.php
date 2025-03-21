<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class FailedMailJob implements ShouldQueue
{
    use Queueable;

    private $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->amount > 100) {
            throw new \Exception('Money Transfer Failed');
        }

        echo "BDT {{ $this->amount }} is transferred Successfully";
    }

    public function failed($exception): void
    {
        Mail::send([], [], function  ($msg){
            $msg->to('admin@example.com')
                ->subject('Failed Money Transfer')
                ->html('Hi, Your Failed Money Transfer');
        });
    }
}
