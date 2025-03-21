<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TransferMoneyJob implements ShouldQueue
{
    use Queueable;

    private $i;

    public function __construct($i)
    {
        $this->i = $i;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // if ($this->amount > 100 && $this->attempts() < 3) {
        //     throw new \Exception('Money Transfer Failed');
        // }
        sleep(2);

        echo "BDT {{ $this->i }} is transferred Successfully";
    }
}
