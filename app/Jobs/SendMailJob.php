<?php

namespace App\Jobs;

use App\Mail\TestMail;
use App\Mail\AdminMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailJob implements ShouldQueue
{
    use Queueable;

    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new TestMail($this->user));
        Mail::to('admin@example.com')->send(new AdminMail($this->user));
    }
}
