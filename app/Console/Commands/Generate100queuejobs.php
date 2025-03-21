<?php

namespace App\Console\Commands;

use App\Jobs\TransferMoneyJob;
use Illuminate\Support\Arr;
use Illuminate\Console\Command;

class Generate100queuejobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate100queuejobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        for ($i = 1; $i <= 100; $i++) {
            // $amount = rand(90, 110);
            $queue = Arr::random(['default', 'custom'], 1)[0];

            echo "BDT $i to queue $queue \n";
            dispatch(new TransferMoneyJob($i))->onQueue($queue);
        }

        echo "100 jobs generated successfully";
    }
}
