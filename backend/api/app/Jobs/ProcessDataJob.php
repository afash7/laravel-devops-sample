<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3; // چند بار تلاش

    public function handle()
    {
        // شبیه‌سازی پردازش سنگین
        sleep(2);

        Log::info('Data processed successfully');
    }

    public function failed(\Throwable $exception)
    {
        Log::error('Job failed', [
            'error' => $exception->getMessage()
        ]);
    }
}
