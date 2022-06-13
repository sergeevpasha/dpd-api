<?php

namespace App\Console\Commands;

use App\Jobs\SyncDpd;
use Illuminate\Console\Command;

class SyncData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync DPD data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        SyncDpd::dispatch();
        $this->info('DPD Syncing job dispatched.');
        return 0;
    }
}
